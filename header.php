<?php 
  require_once 'phpClass/autoloader.php'; // chargement des différentes classes php 
  Session::getSession(); // instanciation de la session
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- responsive meta tag also optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>ECEAmazon</title>

    <!-- Compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!--Import fontawesome Icon & Font-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Import animation.css provide better animation-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    
    <!-- Custom styles -->
    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
      <a href="index.php" class="navbar-brand " href="#"><i class="fab fa-artstation text-white"></i> ECE Amazon</a>

      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle disabled" href="http://example.com" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
              <a class="dropdown-item" href="#">modifier les utilisateur</a> <!-- placeholder link -->
              <a class="dropdown-item" href="#">modifier les produits</a>  <!-- placeholder link -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Produits</a> <!-- placeholder link -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-shopping-basket"></i></a>  <!-- placeholder link -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Se Connecter</a>  <!-- placeholder link php affichage -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">S'inscrire</a>  <!-- placeholder link php affichage  -->
          </li> 
          <li class="nav-item disabled">
            <a class="nav-link" href="#">Mon Compte</a>  <!-- placeholder link php affichage -->
          </li>
          <li class="nav-item disabled">
            <a class="nav-link" href="#">Vendre</a>  <!-- placeholder link php affichage -->
          </li>  
        </ul>

      </div>
    </nav>

     <!-- gestion des messages de session par modal -->

    <!-- Button debug trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal"> debug modal </button>
    
    <!-- messageModal -->
    <div class="modal hide fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="modaleTitle" aria-hidden="false">
      <div class="modal-dialog modal-notify modal-info modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modaleTitle"><i class="fas fa-exclamation-triangle fa-2x animated rotateIn text-dark"></i> Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="dropdown-divider"></div>
            <?php
            Session::getSession()->addMessage("success", "message test success");
            Session::getSession()->addMessage("danger", "message test danger");

            if (Session::getSession()->hasMessages() ) {

              foreach (Session::getSession()->getMessages() as $message) {
                $type = explode(Session::$msgSeparator, $message)[0];
                $text = explode(Session::$msgSeparator, $message)[1];
               echo ' <div class="alert alert-'.$type.'" role="alert">
                        <strong>Warning!</strong> '.$text.'
                      </div> ';
              }
            }
            ?>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>