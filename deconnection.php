<?php 
    require_once 'phpClass/autoloader.php';

    Site::getUser()->deconnectionUser();
    
    Site::redirection('index.php');
?>