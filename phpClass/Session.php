<?php

class Session {

    public function __construct() {
        session_start();
    }

    public function ajoutMessage($type, $message) {
        $_SESSION[messages][$type] = $message;
    }

    public function 
}

?>