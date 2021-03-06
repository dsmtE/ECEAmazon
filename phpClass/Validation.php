<?php

class Validation {

    static function isMail($str) {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    static function isAlphanumeric($str) {
        return preg_match('/^[\w- ]+$/', $str);
    }
    
    static function isphoneNumber($str) {
        return preg_match('/^(?:\+33\s|0)[1-9](?:[\/\-\s]?\d{2}){4}$/', $str);
    }
}

?>