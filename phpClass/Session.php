<?php
// source: https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html
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

    public function addMessage($type, $message) {// permet d'ajouter un message
        if(!isset($_SESSION["messages"])) {
            $_SESSION["messages"] = array();
        }
        array_push ($_SESSION["messages"], $type . self::$msgSeparator . $message);
    }

    public function hasMessages() {// permet de voir si il y a un message
        return isset($_SESSION["messages"]);
    }

    public function getMessages() {// permet de recuperer les messages de la session en les supprimant
        $messages = $_SESSION["messages"];
        unset($_SESSION["messages"]);
        return $messages;
    }

    public function connectionUser($db, $idUser) { // permet de connecter un utilisateur
        $_SESSION["user"] = $db->getUser($idUser);
    }

    public function deconnectionUser() {// permet d'ajouter un utilisateur en connection
        if(isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            $this->addMessage('info', 'tu as bien été deconnecté');
        } else {
            $this->addMessage('danger', 'tu n\'est pas connecté');
        }
    }

    public function write($key, $value) { // accesseur qui permet d'ecrire une valeur de session
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

    public function read($key) { // accesseur qui permet de lire une valeur de session
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
}

?>