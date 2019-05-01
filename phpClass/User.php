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
        $strValidation = bin2hex(random_bytes(20));

        // on ajout l'utilisateur à la base de donnée
        $this->db->requete('INSERT INTO Utilisateurs SET nom = ?, prenom = ?, email = ?, tel = ?, admin = 0, mdp = ?, img = ?, imgFond = ?, dateInscription = NULL, strValidation = ?, adresse = NUll, codePostal = NULL, pays = NULL', [$nom, $prenom, $mail, $tel, $mdp, $img, $imgFond, $strValidation]);

        // on récupère son id puis on envoi un mail pour la confirmation
        $idUser = $this->db->getLastInsertId();
        mail($mail, "confirmation d\'inscription", "pour confirmer votre inscription cliquez sur ce lien : \n http://localhost:14/ECEAmazon/confirmationInscription.php?id=".$idUsed.'&str='.$strValidation);

    }

    public function confirmationInscription($idUser, $strValidation) { 
        $user = $this->db->getUser($idUser);
        if($user && $user->strValidation == $strValidation) {// si la chaine est la même 
            // on met à jout la base de donné 
            $this->db->requete('UPDATE Utilisateurs SET strValidation = NULL, dateInscription = NOW() WHERE idUser = ?', [$idUser]);
            $this->session->write('user', $user);
            return true;
        }
        return false;
        
    }

    public function isConnected($warningMsg = "tu n'a pas accès à cette page !") {
        if(!$session->read("user")) {// si l'utilisateur n'est pas connecté
            $this->addMessage('danger', $warningMsg);
            return false;
        }
        return true;
    }

    public function isAdmin($warningMsg = "tu n'est pas administrateur !") {
        $user = $this->db->getUser($idUser);
        if(!$session->read("user") || $user->admin != 1) {// si l'utilisateur n'est pas connecté ou pas admin
            $this->addMessage('danger', $warningMsg);
            return false;
        }
        return true;
    }

    public function connectionUser($idUser) { // permet de connecter un utilisateur
        $this->session->write("user", $this->db->getUser($idUser));
    }

    public function deconnectionUser() {// permet d'ajouter un utilisateur en connection
        if(!$session->read("user")) {
            $session->del("user");
            $this->addMessage('info', 'tu as bien été deconnecté');
        } else {
            $this->addMessage('danger', 'tu n\'est pas connecté');
        }
    }

}

?>