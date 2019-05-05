<?php
    require_once 'phpClass/autoloader.php';

    $db = Site::getDatabase();
    $session = Session::getSession();
    $user =  Site::getUser();

    if (!empty($_GET) && isset($_GET['id']) && isset($_GET['str']) ) {
        if ($user->confirmationInscription($_GET['id'], $_GET['str'])) {

            $session->addMessage('success', 'Validation réussie, tu es maintenant connecté');
            $user->connectionUser($_GET['id']);
        } else {
            $session->addMessage('danger', 'Cette chaîne de validation n\'est pas valide');
        }
    }
    
    Site::redirection('index.php');

    