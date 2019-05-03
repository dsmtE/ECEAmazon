<?php 
include "header.php";
if( !$logged) {
  $this->session->addMessage('danger', 'tu n\'est pas connecté');
  Site::redirection('index.php');
}

?>

<br>
<h3 class="text-center mb-4 mt-1"> Mon compte</h3>
<br>
<br>
<div class="w-100 d-flex justify-content-center">
<form action="" method="POST" class="p-2 w-75">
  <div class="form-group row">
    <label for="nom" class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="nom" placeholder="Nom">
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="prenom" placeholder="Prénom">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="mot de passe" class="col-sm-3 col-form-label">Mot de passe</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="password" class="form-control" id="mot de passe" placeholder="Mot de passe">
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="telephone" placeholder="00 00 00 00 00">
    </div>
  </div>
  <div class="form-group row">
    <label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="adresse" placeholder="Adresse">
    </div>
  </div>
  <div class="form-group row">
    <label for="code postal" class="col-sm-3 col-form-label">Code postal</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="code postal" placeholder="00 000">
    </div>
  </div>
  <div class="form-group row">
    <label for="ville" class="col-sm-3 col-form-label">Ville</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="ville" placeholder="Ville">
    </div>
  </div>
  <div class="form-group row">
    <label for="pays" class="col-sm-3 col-form-label">Pays</label>
    <div class="col-sm-8 offset-sm-1">
      <input type="text" class="form-control" id="pays" placeholder="Pays">
    </div>
  </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="img" name="img">
            <label class="custom-file-label" for="img">modifier l'image de profil</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="imgFond" name="imgFond">
            <label class="custom-file-label" for="imgFond">modifier l'image de fond</label>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary offset-4 col-4 offset-md-9 mr-auto col-md-3">Valider les modifications</button>
</form>
</div>


<?php include "footer.php" ?>




