<?php 
include "header.php";

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $product = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$_GET['id']])->fetch();
} else {
  Session::getSession()->addMessage("info", "cet id ne correspond à aucun produit");
  Site::redirection('produit.php');
  exit();
}

if(!$admin && $product->idVendeur != $user->idUser ) {
  Session::getSession()->addMessage("danger", "Tu n'as pas les autorisations pour modifer ce produit");
  Site::redirection('produit.php');
}

  // TODO

?>
  <body>

<br>
<h3 class="text-center" style="">Modifier mon produit</h3>
<br>
<br>
<form style="padding: 10px;">
  <div class="form-group row">
    <label for="nom produit" class="col-sm-2 col-form-label">Nom Produit</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nomProduit" name="nomProduit" placeholder="Nom Produit">
    </div>
  </div>
  <div class="form-group row">
    <label for="catégorie" class="col-sm-2 col-form-label">Catégorie</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie">
    </div>
  </div>

  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
</div>

  <div class="form-group row">
    <label for="quantité" class="col-sm-2 col-form-label">Quantite</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="quantité" name="quantite" placeholder="XX">
    </div>
</div>
<div class="form-group row">
    <label for="taille" class="col-sm-2 col-form-label">Taille</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="taille" name="taille" placeholder="Laisser vide si taille unique">
    </div>
</div>
<div class="form-group row">
    <label for="couleur" class="col-sm-2 col-form-label">Couleur</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="couleur" name="couleur" placeholder="Rouge,vert,bleu">
    </div>
</div>
<div class="form-group row">
    <label for="modele" class="col-sm-2 col-form-label">Modele</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="modele" name="modele" placeholder="Homme,femme">
    </div>
</div>
<div class="form-group row">
    <label for="prix" class="col-sm-2 col-form-label">Prix</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="prix" name="prix" placeholder="€">
    </div>




    <button type="submit" class="btn btn-primary">Valider les modifications</button>

  </form>



</body>

<?php include "footer.php" ?>



