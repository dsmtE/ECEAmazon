<?php 
include "header.php";

if( !$logged) {
  Session::getSession()->addMessage('danger', 'tu n\'es pas connecté');
  Site::redirection('index.php');
}

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on recoi des données

  $erreurs = array();
  $db = Site::getDatabase();

  !isset($_POST['mdp']) || empty($_POST['mdp']) ? $_POST['mdp'] = $user->mdp : $_POST['mdp'] =  password_hash($_POST['mdp'], PASSWORD_BCRYPT);
  !isset($_POST['nom']) || empty($_POST['nom']) ? $_POST['nom']                      = $user->nom :"";
  !isset($_POST['prenom']) || empty($_POST['prenom']) ?$_POST['prenom']              = $user->prenom :"";
  !isset($_POST['mail']) || empty($_POST['mail']) ? $_POST['mail']                   = $user->mail :"";
  !isset($_POST['telephone']) || empty($_POST['telephone']) ? $_POST['telephone']    = $user->tel :"";
  !isset($_POST['adresse']) || empty($_POST['adresse']) ? $_POST['adresse']          = isset($user->adresse) ? $user->adresse : null :"";
  !isset($_POST['codePostal']) || empty($_POST['codePostal']) ? $_POST['codePostal'] = isset($user->codePostal) ? $user->codePostal : null :"";
  !isset($_POST['ville']) || empty($_POST['ville']) ? $ $_POST['ville']              = isset($user->ville) ? $user->ville : null  :"";
  !isset($_POST['pays']) || empty($_POST['pays']) ? $_POST['pays']                   = isset($user->pays) ? $user->pays : null  :"";
  !isset($_POST['img']) || empty($_POST['img']) ? $_POST['img']                      = $user->img :"";
  !isset($_POST['imgFond']) || empty($_POST['imgFond']) ? $_POST['imgFond']          = $user->imgFond :"";


  //print_r($_POST);

// test nom
  if(!Validation::isAlphanumeric($_POST['nom']) ) {
    array_push($erreurs, "le nouveau nom n'est pas valide");
  }
// test prénom
  if(!Validation::isAlphanumeric($_POST['prenom']) ) {
    array_push($erreurs, "le nouveau prenom n'est pas valide");
  }  

// test mail
  if(!Validation::isMail($_POST['mail']) ) {
    array_push($erreurs, "le nouvel mail n'est pas valide");
  } 

// test tel
  /*
  if(!Validation::isphoneNumber($_POST['telephone']) ) {
    array_push($erreurs, "le nouveau telephone n'est pas valide");
  } 
  */

/*
// test mot de passe
  if(!Validation::isAlphanumeric($_POST['mdp']) ) {
    array_push($erreurs, "le nouveau mdp n'est pas valide");
  } 
    
    */

 // test code postal
  if($_POST['codePostal'] != null && !Validation::isAlphanumeric($_POST['codePostal']) ) {
    array_push($erreurs, "le nouveau code postal n'est pas valide");
  }      

 // test ville
  if($_POST['ville'] != null && !Validation::isAlphanumeric($_POST['ville']) ) {
    array_push($erreurs, "la nouvelle ville n'est pas valide");
  }      

 // test pays
  if($_POST['pays'] != null && !Validation::isAlphanumeric($_POST['pays']) ) {
    array_push($erreurs, "le nouveau pays n'est pas valide");
  }    
  

  if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

    Site::getUser()->modificationCompte( $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['mdp'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['pays'], $_POST['img'], $_POST['imgFond']);

    Site::redirection("index.php");

  }else {
    Session::getSession()->addMessages('danger', $erreurs);
    Site::rechargerPage();
  }
}
?>

<h3 class="text-center mb-2 mt-2"> Mon compte</h3>

<div class="w-100 d-flex justify-content-center">
<form class="p-2 w-75" action="" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="nom" class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="nom" placeholder=<?php echo '"'.$user->nom.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="prenom" placeholder=<?php echo '"'.$user->prenom.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="email" class="form-control" name="mail" placeholder=<?php echo '"'.$user->mail.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="telephone" placeholder=<?php echo '"'.$user->tel.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="mot de passe" class="col-sm-3 col-form-label">Mot de passe</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="password" class="form-control" name="mdp" placeholder="********">
    </div>
  </div>
  <div class="form-group row">
    <label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="adresse" placeholder=<?php echo isset($user->adresse) ? "'".$user->adresse."'" : null; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="code postal" class="col-sm-3 col-form-label">Code postal</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="codePostal" placeholder=<?php echo '"'.isset($user->codePostal) ? $user->codePostal : null.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="ville" class="col-sm-3 col-form-label">Ville</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="ville" placeholder=<?php echo '"'.isset($user->ville) ? $user->ville : null.'"'; ?>>
    </div>
  </div>
  <div class="form-group row">
    <label for="pays" class="col-sm-3 col-form-label">Pays</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" name="pays" placeholder=<?php echo '"'.isset($user->pays) ? $user->pays : null.'"'; ?>>
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

<?php include "footer.php"; ?>