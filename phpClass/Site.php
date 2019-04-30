<?php

class Site {

    static $db = null; // variable static de l'instance base de donnée
    static $session = null; // variable static de l'instance session

    static public function getDatabase() {
        if(!self::$db) {
            self::$db = new DB("ECEAmazon");
        }
        return self::$db;
    }

    static public function getSession() {
        if(!self::$session) {
            self::$session = new Session();
        }
        return self::$session;
    }

    static public function redirection($url) {
        header("location : $url");
    }
}

?>