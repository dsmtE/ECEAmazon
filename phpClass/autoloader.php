<?php

spl_autoload_register(function ($class) {
    try {
        include  "class/$class.php";
    } catch (Exception $e) {
        echo $"erreur de chargement de la class : $class\n";
        echo $e."\n";
    }   
});

?>