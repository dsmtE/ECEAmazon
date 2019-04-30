<?php
// source: https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html
class Session {

    private static $instance = null; // variable static de l'instance session singleton

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
        $_SESSION["messages"][$type] = $message;
    }

    public function hasMessages() {// permet de voir si il y a un message
        return isset($_SESSION["messages"]);
    }

    public function getMessages() {// permet de recuperer les messages de la session en les supprimant
        $messages = $_SESSION["messages"];
        unset($_SESSION[messages]);
        return $mssages;
    }
}

?>