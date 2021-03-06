<?php
class User {

    private $db;
    private $session;

    public function __construct($db, $session) {
        $this->db = $db;
        $this->session = $session;
    }

    public function inscription($nom, $prenom, $mail, $tel, $mdp, $img, $imgFond) {
        //source: https://www.php.net/manual/fr/function.password-hash.php
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);

        //source: https://www.geeksforgeeks.org/generating-random-string-using-php/
        // permet de generer une chaine aléatoire
        $strValidation = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 60)), 0, 60);

        // on ajout l'utilisateur à la base de donnée
        $this->db->requete('INSERT INTO Utilisateurs (nom, prenom, mail, tel, mdp, img, imgFond, strValidation ) VALUES ("'.$nom.'", "'.$prenom.'", "'.$mail.'", '.$tel.', "'.$mdp.'", "'.$img.'", "'.$imgFond.'", "'.$strValidation.'")');

        // on récupère son id puis on envoi un mail pour la confirmation
        $idUser = $this->db->getLastInsertId();


        // $message = "pour confirmer votre inscription cliquez sur ce lien : \r\n http://localhost:14/ECEAmazon/confirmationInscription.php?id=".$idUser.'&str='.$strValidation;
        // $headers = 'From: ECEAmazon@ecommerce.com' . "\r\n" .
        // 'X-Mailer: PHP/' . phpversion();
        // mail($mail,  "confirmation d'inscription", $message, $headers);

        $this->session->addMessage('info',"pour confirmer votre inscription cliquez sur ce lien : \n http://localhost:14/ECEAmazon/confirmationInscription.php?id=".$idUser.'&str='.$strValidation );
    }

    public function modificationCompte($nom, $prenom, $mail, $tel, $mdp, $adresse, $codePostal, $ville, $pays, $img, $imgFond) {

        $this->db->requete('UPDATE Utilisateurs SET nom = ?, prenom = ?, mail = ?, tel = ?, mdp = ?, adresse = ?, codePostal = ?, ville = ?, pays = ?, img = ?, imgFond = ? WHERE mail = ?', [$nom, $prenom, $mail, $tel, $mdp, $adresse, $codePostal, $ville, $pays, $img, $imgFond, $mail]);

        //rechargement de la session en conséquence 
        $this->session->write('user', $this->db->getUserById($this->session->read('user')->idUser));

        $this->session->addMessage('info',"ton compte à bien été modifé");
    }

    public function confirmationInscription($idUser, $strValidation) { 
        $user = $this->db->getUserById($idUser);
        if($user && $user->strValidation == $strValidation) {// si la chaine est la même 
            // on met à jout la base de donné 
            $this->db->requete('UPDATE Utilisateurs SET strValidation = NULL, dateInscription = NOW() WHERE idUser = ?', [$idUser]);
            $this->session->write('user', $user);
            return true;
        }
        return false;
        
    }

    public function isConnected() {
        return $this->session->read("user") != null;
    }

    public function isValidated($mail) {
        $user = $this->compteExistantbyMail($mail);
        return $user && $user->dateInscription != null;
    }

    public function isAdmin() {
        $user = $this->session->read("user");
        return $user != null && $user->admin == 1;
    }

    public function connectionUser($idUser) { // permet de connecter un utilisateur
        $this->session->write("user", $this->db->getUserById($idUser));
    }

    public function deconnectionUser() {// permet de deconnecter un utilisateur
        if($this->session->read("user")) {
            $this->session->del("user");
            $this->session->addMessage('info', 'tu as bien été deconnecté');
        } else {
            $this->session->addMessage('danger', 'tu n\'est pas connecté');
        }
    }

    public function compteExistantbyMail($mail) {
        return $this->db->requete('SELECT * FROM Utilisateurs WHERE mail = ?', [$mail])->fetch();
    }

}

?>