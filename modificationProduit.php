<?php include "header.php" ?>


  <body>

<br>
<h3 class="text-center" style="">Modifier mon produit</h3>
<br>
<br>
<form style="padding: 10px;">
  <div class="form-group row">
    <label for="nom produit" class="col-sm-2 col-form-label">Nom Produit</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nom produit" placeholder="Nom Produit">
    </div>
  </div>
  <div class="form-group row">
    <label for="catégorie" class="col-sm-2 col-form-label">Catégorie</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="catégorie" placeholder="Catégorie">
    </div>
  </div>

  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="description" rows="3"></textarea>
  </div>
</div>

  <div class="form-group row">
    <label for="quantité" class="col-sm-2 col-form-label">Quantité</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="quantité" placeholder="XX">
    </div>
</div>
<div class="form-group row">
    <label for="taille" class="col-sm-2 col-form-label">Taille</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="taille" placeholder="Laisser vide si taille unique">
    </div>
</div>
<div class="form-group row">
    <label for="couleur" class="col-sm-2 col-form-label">Couleur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="couleur" placeholder="Rouge,vert,bleu">
    </div>
</div>
<div class="form-group row">
    <label for="modele" class="col-sm-2 col-form-label">Modèle</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="modele" placeholder="Homme,femme">
    </div>
</div>
<div class="form-group row">
    <label for="prix" class="col-sm-2 col-form-label">Prix</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="prix" placeholder="€">
    </div>
</div>

  
    
      
      <button type="submit" class="btn btn-primary">Valider les modifications</button>

</form>



</body>

<?php include "footer.php" ?>



