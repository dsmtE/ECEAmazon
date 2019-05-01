<?php include "header.php" ?>


  <body>

<br>
<h3 class="text-center" style="">Inscription</h3>
<br>
<br>
<form style="padding: 10px;">
  <div class="form-group row">
    <label for="nom" class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nom" placeholder="Nom">
    </div>
  </div>
  <div class="form-group row">
    <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="prenom" placeholder="Prénom">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-8">
      <input type="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="mot de passe" class="col-sm-2 col-form-label">Mot de passe</label>
    <div class="col-sm-8">
    <input type="password" class="form-control" id="mot de passe" placeholder="Mot de passe">
    </div>
  </div>
   <div class="form-group row">
    <label for="mot de passe" class="col-sm-2 col-form-label">Confirmation</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="mot de passe" placeholder="Veuillez confirmer le mot de passe">
    </div>
  </div>
  <div class="form-group row">
    <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="telephone" placeholder="00 00 00 00 00">
    </div>
</div>

  <div class="form-group row">
    <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Importer une image</label>
    <div class="col-sm-8">
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
</div>

<div class="form-group row">
    <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Importer un fond</label>
    <div class="col-sm-8">
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
</div>
    
      
      <button type="submit" class="btn btn-primary">Valider inscription</button>

</form>



</body>

<?php include "footer.php" ?>



