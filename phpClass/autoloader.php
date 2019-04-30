<?php
spl_autoload_register('loadClass');

function loadClass($class) {
    require "phpClass/$class.php";
}
?>