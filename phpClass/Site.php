<?php

class Site {

    static $db = null; // variable static de l'instance base de donnée
    static $user = null; // variable static de l'instance utilisateur

    static public function getDatabase() {
        if(!self::$db) {
            self::$db = new DB("ECEAmazon");
        }
        return self::$db;
    }

    static public function getUser() {
        if(!self::$user) {
            self::$user = new User(self::$db, Session::getSession());
        }
        return self::$user;
    }

    static public function redirection($url) {
        header("location : $url");
    }

    static public function rechargerPage() {
        header("Refresh:0");
    }
}

?>