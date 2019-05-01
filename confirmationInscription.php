<?php
    require_once 'phpClass/autoloader.php';
    $db = Site::getDatabase();
    $session = Session::getSession()

    $user = new User($db, $session);

    if (!empty($_GET) && isset($_GET['id']) && isset($_GET['str']) ) {
        if ($user->confirmationInscription($_GET['id'], $_GET['str'])) {

            $session->addMessage('success', 'Validation réussi tu es maintenant connecté');
            $session->connectionUser($_GET['id']);
        } else {
            $session->addMessage('danger', 'cette chaine de validation n\'est pas valide');
        }
    }
    
    Site::redirection('index.php');

    