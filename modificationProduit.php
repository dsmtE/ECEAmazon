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

$user = Session::getSession()->read("produit");

if(!empty($_POST)) { // si on reçoit des données

  $erreurs = array();
  $db = Site::getDatabase();

  !isset($_POST['nom']) || empty($_POST['nom']) ? $_POST['nom']                      = $produit->nom :"";
  !isset($_POST['categorie']) || empty($_POST['categorie']) ?$_POST['categorie']              = $produit->categorie :"";
  !isset($_POST['description']) || empty($_POST['description']) ? $_POST['description']    = $produit->description :"";
  !isset($_POST['quantity']) || empty($_POST['quantity']) ? $_POST['quantity']          = $produit->adresse :"";
  !isset($_POST['taille']) || empty($_POST['taille']) ? $_POST['taille']          = $produit->taille :"";
  !isset($_POST['couleur']) || empty($_POST['couleur']) ? $_POST['couleur']          = $produit->couleur :"";
  !isset($_POST['modele']) || empty($_POST['modele']) ? $_POST['modele']          = $produit->modele :"";
  !isset($_POST['prix']) || empty($_POST['prix']) ? $_POST['prix']          = $produit->prix :"";



// test nom
  if(!Validation::isAlphanumeric($_POST['nom']) ) {
    array_push($erreurs, "le nouveau nom n'est pas valide");
  }
// test catégorie
  if(!Validation::isAlphanumeric($_POST['categorie']) ) {
    array_push($erreurs, "la nouvelle categorie n'est pas valide");
  }  

// test description
  if(!Validation::isAlphanumeric($_POST['description']) ) {
    array_push($erreurs, "la nouvelle description n'est pas valide");
  } 

// test qauntité
  if(!Validation::isAlphanumeric($_POST['quantity']) ) {
    array_push($erreurs, "la nouvelle qauntité n'est pas valide");
  } 

// test taille
  if(!Validation::isAlphanumeric($_POST['taille']) ) {
    array_push($erreurs, "la nouvelle taille n'est pas valide");
  } 

// test couleur
  if(!Validation::isAlphanumeric($_POST['couleur']) ) {
    array_push($erreurs, "la nouvelle couleur n'est pas valide");
  } 

// test modele
  if(!Validation::isAlphanumeric($_POST['modele']) ) {
    array_push($erreurs, "le nouveau modele n'est pas valide");
  } 

// test prix
  if(!Validation::isAlphanumeric($_POST['prix']) ) {
    array_push($erreurs, "le nouveau prix n'est pas valide");
  } 

 

  if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

    Site::getUser()->modificationCompte( $_POST['nom'], $_POST['categorie'], $_POST['description'], $_POST['quantity'], $_POST['taille'], $_POST['couleur'], $_POST['modele'], $_POST['prix']);

    //rechergement des informations utilisateur dans la sesion
    Session::getSession()->write('produit', $db->getProduitById($produit->idProduit));

    Site::redirection("index.php");

  }else {
    Session::getSession()->addMessages('danger', $erreurs);
    Site::rechargerPage();
  }
}

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
      <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom Produit">
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
      <input type="text" class="form-control" id="quantity" name="quantity" placeholder="XX">
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



