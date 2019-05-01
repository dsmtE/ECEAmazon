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