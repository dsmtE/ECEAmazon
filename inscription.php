<?php
include "header.php";
$session = Session::getSession();

if($logged) {
  $session->addMessage('info', 'tu es  déjà connecté');
  Site::redirection('index.php');
}


if(!empty($_POST)) { // si on recoi des données

  $erreurs = array();
  $db = Site::getDatabase();

// test nom
  if( !isset($_POST['nom']) || empty($_POST['nom']) ) {
    array_push($erreurs, "tu n\'a pas rentré de nom");
  } else {
    if( !Validation::isAlphanumeric($_POST['nom']) ) {
      array_push($erreurs, "ton nom n'est pas valide");
    }
  }

// test mail
  if( !isset($_POST['mail']) || empty($_POST['mail']) ) {
    array_push($erreurs, "tu n\'a pas rentré de mail");
  } else {
    if( !Validation::isMail($_POST['mail']) ) {
      array_push($erreurs, "ton mail n'est pas valide");
    } else {
      if( Site::getUser()->compteExistantbyMail($_POST['mail']) ) {
        array_push($erreurs, "Un compte avec cette adresse existe déjà");
      }
    }
  }

// test mdp
  if( !isset($_POST['mdp']) || empty($_POST['mdp']) ) {
    array_push($erreurs, "tu n\'a pas rentré de mot de passe");
  } else {
    if( !Validation::isAlphanumeric($_POST['mdp']) ) {
      array_push($erreurs, "ton mdp n'est pas valide il doit être composé uniquement de caractères alpha numérique");
    } else {
      if( $_POST['mdp'] != $_POST['mdpConfirm']) {
        array_push($erreurs, "la confirmation du mot de passe n'est pas valide");
      }
    }
  }

// test tel
  if( !isset($_POST['telephone']) || empty($_POST['telephone']) ) {
    array_push($erreurs, "tu n\'a pas rentré de numero de telephone");
  } else {
    if( !Validation::isphoneNumber($_POST['telephone']) ) {
      array_push($erreurs, "Ton numero de telephone n'est pas valide");
    } else {
      $_POST['telephone'] = preg_replace('/[\/\- ,]/', '', $_POST['telephone']);// on converti le numero de tel
    }
  }

// test img
  if( !isset($_POST['img']) || empty($_POST['img']) ) {
    array_push($erreurs, "tu n'as pas choisi d'image");
  }

// test imgFond
  if( !isset($_POST['imgFond']) || empty($_POST['imgFond']) ) {
    array_push($erreurs, "tu n'as pas choisi d'image de fond");
  }


if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

  Site::getUser()->inscription( $_POST['nom'],$_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['mdp'], $_POST['img'], $_POST['imgFond']);
  $session->addMessage('success', "Ton compte à bien été crée, un mail de confirmation t'a été envoyé.");

}else {
  $session->addMessages('danger', $erreurs);
}

}

?>
  <h3 class="text-center mb-4 mt-1">Inscription</h3>
<!-- <div class="row justify-content-center"> -->
  <div class="w-100 d-flex justify-content-center">
    <form action="" method="POST" class="p-2 w-75">
      <div class="form-group row">
        <label for="nom" class="col-sm-3 col-form-label">Nom</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="text" name="nom"class="form-control" id="nom" placeholder="Nom">
        </div>
      </div>
      <div class="form-group row">
        <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prénom">
        </div>
      </div>
      <div class="form-group row">
        <label for="mail" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="email" name="mail" class="form-control" id="mail" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="mdp" class="col-sm-3 col-form-label">Mot de passe</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="password" name="mdp" class="form-control" id="mdp" placeholder="Mot de passe">
        </div>
      </div>
      <div class="form-group row">
        <label for="mdpConfirm" class="col-sm-3 col-form-label">Confirmation</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="password" name="mdpConfirm" class="form-control" id="mdpConfirm" placeholder="Veuillez confirmer le mot de passe">
        </div>
      </div>
      <div class="form-group row">
        <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
        <div class="col-sm-8 offset-sm-1">
          <input type="text" name="telephone" class="form-control" id="telephone" placeholder="00 00 00 00 00">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="img" name="img">
            <label class="custom-file-label" for="img">Importer une image de profil</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="imgFond" name="imgFond">
            <label class="custom-file-label" for="imgFond">Importer une image de fond</label>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary offset-4 col-4 offset-md-9 mr-auto col-md-3">Valider inscription</button>
    </form>
  </div>
<!-- </div> -->

<?php include "footer.php" ?>