<?php

class Validation {

    static function isMail($str) {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    static function isAlphanumeric($str) {
        return preg_match('/^[\w-]+$/', $str);
    }
    
}

?>