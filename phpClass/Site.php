<?php

class Site {

    static $db = null; // variable static de l'instance base de donnée

    static public function getDatabase() {
        if(!self::$db) {
            self::$db = new DB("ECEAmazon");
        }
        return self::$db;
    }

    static public function redirection($url) {
        header("location : $url");
    }

    static public function rechargerPage() {
        header("Refresh:0");
    } 
}

?>s