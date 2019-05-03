<?php 
include "header.php";

if( !$logged) {
  $this->session->addMessage('danger', 'tu n\'es pas connecté');
  Site::redirection('index.php');
}

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on recoi des données

  $erreurs = array();
  $db = Site::getDatabase();

// test nom
  if( isset($_POST['nom'] && !Validation::isAlphanumeric($_POST['nom']) )) {
      array_push($erreurs, "le nouveau nom n'est pas valide");
  }

// test prénom
  if( isset($_POST['prenom'] && !Validation::isAlphanumeric($_POST['prenom']) )) {
      array_push($erreurs, "le nouveau prenom n'est pas valide");
  }  

// test mail
  if( isset($_POST['mail'] && !Validation::isMail($_POST['mail']) )) {
      array_push($erreurs, "le nouvel mail n'est pas valide");
    } 

// test tel
  if( isset($_POST['telephone'] && !Validation::isphoneNumer($_POST['telephone']) )) {
      array_push($erreurs, "le nouveau telephone n'est pas valide");
  }       


// test mot de passe
  if( isset($_POST['mdp'] && !Validation::isAlphanumeric($_POST['mdp']) )) {
      array_push($erreurs, "le nouveau mdp n'est pas valide");
  } 

// test adresse
  if( isset($_POST['adresse'] && !Validation::isAlphanumeric($_POST['adresse']) )) {
      array_push($erreurs, "la nouvelle adresse n'est pas valide");
  }   

 // test code postal
  if( isset($_POST['codePostal'] && !Validation::isAlphanumeric($_POST['codePostal']) )) {
      array_push($erreurs, "le nouveau code postal n'est pas valide");
  }      

 // test ville
  if( isset($_POST['ville'] && !Validation::isAlphanumeric($_POST['ville']) )) {
      array_push($erreurs, "la nouvelle ville n'est pas valide");
  }      

 // test pays
  if( isset($_POST['pays'] && !Validation::isAlphanumeric($_POST['pays']) )) {
      array_push($erreurs, "le nouveau pays n'est pas valide");
  }    

  // test img
if( !isset($_POST['img']) || empty($_POST['img']) ) {
  array_push($erreurs, "tu n'as pas choisi d'image");
}

// test imgFond
if( !isset($_POST['imgFond']) || empty($_POST['imgFond']) ) {
  array_push($erreurs, "tu n'as pas choisi d'image de fond");
}  

}


if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

Site::getUser()->modificationCompte( $_POST['nom'],$_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['mdp'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['pays'], $_POST['img'], $_POST['imgFond']);

}else {
  $session->addMessages('danger', $erreurs);
}

}

?>



<h3 class="text-center mb-4 mt-1"> Mon compte</h3>

<div class="w-100 d-flex justify-content-center">
<form action="" method="POST" class="p-2 w-75">
  <div class="form-group row">
    <label for="nom" class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="nom" placeholder=<?php echo '"'.$user->nom.'"'; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="prenom" placeholder=<?php echo '"'.$user->prenom.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="email" class="form-control" id="email" placeholder=<?php echo '"'.$user->mail.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="telephone" placeholder=<?php echo '"'.$user->telephone.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="mot de passe" class="col-sm-3 col-form-label">Mot de passe</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="password" class="form-control" id="mot de passe" placeholder=<?php echo '"'.$user->mdp.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="adresse" placeholder=<?php echo '"'.$user->adresse.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="code postal" class="col-sm-3 col-form-label">Code postal</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="code postal" placeholder=<?php echo '"'.$user->codePostal.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="ville" class="col-sm-3 col-form-label">Ville</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="ville" placeholder=<?php echo '"'.$user->ville.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="pays" class="col-sm-3 col-form-label">Pays</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="pays" placeholder=<?php echo '"'.$user->pays.'"'; ?>>
    </div>
  </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="img" name="img">
            <label class="custom-file-label" for="img">Modifier l'image de profil</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="imgFond" name="imgFond">
            <label class="custom-file-label" for="imgFond">Modifier l'image de fond</label>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary offset-4 col-4 offset-md-9 mr-auto col-md-3">Valider les modifications</button>
</form>
</div>


<?php include "footer.php" ?>




