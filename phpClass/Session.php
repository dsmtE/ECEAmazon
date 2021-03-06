<?php
// source: https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html
// source: https://www.php.net/manual/fr/reserved.variables.session.php
class Session {

    private static $instance = null; // variable static de l'instance session singleton

    static $msgSeparator = '/*s*/';

    private function __construct() {
        session_start();
    }

    public static function getSession() {
        if(!self::$instance) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    //----------  gestion des messages ----------
    public function addMessage($type, $message) {// permet d'ajouter un message
        if(!isset($_SESSION["messages"])) {
            $_SESSION["messages"] = array();
        }
        array_push ($_SESSION["messages"], $type . self::$msgSeparator . $message);
    }

    public function addMessages($type, $arrayMsg) {// permet d'ajouter des messages depuis un talbeau
        foreach ($arrayMsg as $msg){
            $this->addMessage($type, $msg);
        }
    }

    public function hasMessages() {// permet de voir si il y a un message
        return isset($_SESSION["messages"]);
    }

    public function getMessages() {// permet de recuperer les messages de la session en les supprimant
        $messages = $_SESSION["messages"];
        unset($_SESSION["messages"]);
        return $messages;
    }

    //----------  gestionaddToPanier du panier ----------
    public function addToPanier($idProduit, $option, $quantity = 1) {// permet dun produit au panier
        if(!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = array();
        }

        $exist = false;
        foreach ($_SESSION["panier"] as $key => $product) {
            if($product['idProduit'] == $idProduit ) {
            $exist = true;
            break;
            }
        }
        if(!$exist){
            array_push ($_SESSION["panier"], array ('idProduit' => $idProduit, 'quantity' => $quantity, 'option' => $option) );
        }
        return !$exist;
    }

    public function panierIsEmpty() {// permet de savoir si il y a des elements dans le panier
        return isset($_SESSION["panier"]);
    }

    public function panierChangeQuantity($db, $idProduit, $variationQuantity) {
        if(!empty($_SESSION["panier"])) {
            foreach ($_SESSION["panier"] as $key => $product) {
                if($product['idProduit'] == $idProduit ) {
                    $_SESSION["panier"][$key]['quantity'] += $variationQuantity;

                    if($_SESSION["panier"][$key]['quantity'] <= 0) {
                        unset($_SESSION["panier"][$key]);
                        $this->addMessage('danger', 'l\'élément à été supprimer du panier');
                    }else {

                        $quantityDispo = $db->requete('SELECT * FROM Produits WHERE idProduit = ?', [ $product['idProduit'] ])->fetch()->quantity;

                        if($_SESSION["panier"][$key]['quantity'] >  $quantityDispo) {
                            $_SESSION["panier"][$key]['quantity'] = $quantityDispo;
                            $this->addMessage('danger', 'tu ne peut pas acheter plus de '.$quantityDispo.' fois cet article');
                        }
                    }

                    break;
                }
            }
        }else{
            $this->addMessage('info', 'ton panier est vide');
        }
    }


    public function panierTotal($db) {
        $total = 0;
        foreach ($this->getPanierElems() as $product) {
            $produitInfos = $db->requete('SELECT * FROM Produits WHERE idProduit = '.$product['idProduit'])->fetch();
            $total += $produitInfos->prix*$product['quantity'];
        }
        return $total;
    }

    public function getPanierElems() {// permet de recuperer les produits
        if(!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = array();
        }
        return $_SESSION["panier"];
    }

    public function viderPanier() {
        unset($_SESSION["panier"]);
    }

    public function passerCommande($db){
        foreach ($this->getPanierElems() as $produit) {
            
            $db->requete('INSERT INTO achats (idAcheteur, idProduit, quantity, dateAchat, caraSelect) VALUES ("'.$_SESSION['user']->idUser.'", '.$produit['idProduit'].','.$produit['quantity'].', NOW(),"'.$produit['option'].'")');

            $quantiteActuelle = $db->requete('SELECT quantity FROM Produits WHERE idProduit = '.$produit['idProduit'])->fetch()->quantity;
            $panierTot = $this->panierTotal($db);

            $db->requete('UPDATE Produits SET quantity = '.($quantiteActuelle - $produit['quantity']).' WHERE idProduit = '.$produit['idProduit']);
        }
        $this->addMessage('success', 'tu as bien passé commande pour un total de '.$panierTot);
        $this->viderPanier();
    }

    public function write($key, $value) { // accesseur qui permet d'ecrire une valeur de session
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

    public function read($key) { // accesseur qui permet de lire une valeur de session
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }

    public function del($key) {
        unset($_SESSION[$key]);
    }
}
?>