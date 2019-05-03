<?php 
  require_once 'phpClass/autoloader.php'; // chargement des différentes classes php 

  $logged = Site::getUser()->isConnected(); // savoir si l'utilisateur est connecté
  $admin = Site::getUser()->isAdmin(); // savoir si l'utilisateur est connecté et admin

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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-8">
      <a href="index.php" class="navbar-brand " href="#"><i class="fab fa-artstation text-white"></i> ECE Amazon</a>

      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto">
          <?php if($admin) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle disabled" href="http://example.com" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
              <a class="dropdown-item" href="modificationUsers.php">Modifier les utilisateur</a>
              <a class="dropdown-item" href="#">Modifier les produits</a>  <!-- placeholder link -->
            </div>
          </li>
          <?php } ?>
          
          <li class="nav-item">
            <a class="nav-link" href="produit.php">Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="panier.php"><i class="fas fa-shopping-basket"></i></a>  <!-- placeholder link -->
          </li>
          <?php if(!$logged) { ?>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Se connecter</a> 
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inscription.php">S'inscrire</a> 
          </li>
          <?php }else{ ?>
          <li class="nav-item disabled">
            <a class="nav-link" href="compte.php">Mon compte</a>  <!-- placeholder link -->
          </li>
          <li class="nav-item disabled">
            <a class="nav-link" href="#">Vendre</a>  <!-- placeholder link-->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deconnection.php">Se déconnecter</a>
          </li>
          <?php } ?>
        </ul>

      </div>
    </nav>

     <!-- gestion des messages de session par modal -->
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

            if (Session::getSession()->hasMessages() ) {

              foreach (Session::getSession()->getMessages() as $message) {
                $type = explode(Session::$msgSeparator, $message)[0];
                $text = explode(Session::$msgSeparator, $message)[1];
               echo ' <div class="alert alert-'.$type.'" role="alert">
                        <strong>Warning!</strong> '.$text.'
                      </div> ';
              }

               echo '<span id="messageModalShow"></span>'; // permet de savoir si il faut afficher ou non la modal
            }
            ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>