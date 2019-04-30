<?php

class Session {

    public function __construct() {
        session_start();
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