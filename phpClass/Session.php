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

    //----------  gestion du panier ----------
    public function addToPanier($idProduit, $option, $quantity = 1) {// permet dun produit au panier
        if(!isset($_SESSION["panier"])) {
            $_SESSION["panier"] = array();
        }
        array_push ($_SESSION["panier"], array ('idProduit' => $idProduit, 'quantity' => $quantity, 'option' => $option) );
    }

    public function panierIsEmpty() {// permet de savoir si il y a des elements dans le panier
        return isset($_SESSION["panier"]);
    }

    public function panierChangeQuantity($idProduit, $variationQuantity) {
        if(!empty($_SESSION["panier"])) {
            foreach ($_SESSION["panier"] as $key => $product) {
                if($product['idProduit'] == $idProduit ) {
                    $_SESSION["panier"]['quantity'] += variationQuantity;
                    if($_SESSION["panier"]['quantity'] <= 0) {
                        unset($_SESSION["panier"][$key]);
                        $this->addMessage('danger', 'l\'élément à été supprimer du panier');
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
        foreach ($_SESSION["panier"] as $product) {
            $dbProduct = $db->requete("SELECT * FROM PRoduits WHERE idProduit == ? ", [$product['idProduit']]);
            $total += $dbProduct->prix*$product['quantity'];
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