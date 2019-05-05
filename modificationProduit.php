<?php 
include "header.php";

if(isset($_GET['id']) && !empty($_GET['id'])) {
  $product = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$_GET['id']])->fetch();
} else {
  Session::getSession()->addMessage("info", "cet id ne correspond à aucun produit");
  Site::redirection('produit.php');
  exit();
}

if(!$admin) {
  if($product->idVendeur != Session::getSession()->read('user')->idUser) {
  Session::getSession()->addMessage("danger", "Tu n'as pas les autorisations pour modifer ce produit");
  Site::redirection('produit.php');
  }
}

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on reçoit des données

  !isset($_POST['productName']) || empty($_POST['productName']) ? $_POST['productName'] = $product->nom :"";
  !isset($_POST['categorie']) || empty($_POST['categorie']) ?$_POST['categorie']        = $product->categorie :"";
  !isset($_POST['description']) || empty($_POST['description']) ? $_POST['description'] = $product->description :"";
  !isset($_POST['price']) || empty($_POST['price']) ? $_POST['price']                   = $product->prix :"";
  !isset($_POST['quantity']) || empty($_POST['quantity']) ? $_POST['quantity']          = $product->quantity :"";
  !isset($_POST['img']) || empty($_POST['img']) ? $_POST['img']                         = $product->img :"";

  $erreurs = array();

  if( !isset($_POST['productName']) || empty($_POST['productName']) ) {
    array_push($erreurs, "tu n\'a pas rentré de nom de produit");
  }

  if( !isset($_POST['categorie']) || empty($_POST['categorie']) ) {
    array_push($erreurs, "tu n\'a pas choisi de catégorie");
  }

  if( !isset($_POST['description']) || empty($_POST['description']) ) {
    array_push($erreurs, "tu n\'a pas ecrit de description");
  }

  if( !isset($_POST['price']) || empty($_POST['price']) ) {
    array_push($erreurs, "tu n\'a pas rentré de prix");
  }

  if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à la modification

    //modification du produit dans la base de donnée
    Site::getDatabase()->requete('UPDATE Produits SET nom = ?, categorie = ?, description = ?, prix = ?, quantity = ?, img = ? WHERE idPRoduit = ?', [$_POST['productName'], $_POST['categorie'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['img'],  $product->idProduit]);

    //delete choix dispo produit asocié
    Site::getDatabase()->requete('DELETE FROM ChoixDispoProduits WHERE idProduit = ?', [$product->idProduit]);

    //ajout choix dispo produits
    foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { 
      foreach (Site::getDatabase()->requete("SELECT choix.idChoix, choix.nom FROM CaraChoix as choix JOIN Carateristiques AS cara ON choix.idCara = cara.idCara  WHERE  cara.idCara = ?", [$cara->idCara]) as $choix) {

        if(isset($_POST[$cara->nom."_".$choix->nom])) {
          Site::getDatabase()->requete('INSERT INTO ChoixDispoProduits (idProduit, idChoix) VALUES ('.$product->idProduit.', '.$choix->idChoix.')');
        }
      }
    }

    //redirection
    Session::getSession()->addMessage('info',' le produit à été mis à jour');
    Site::redirection("modificationDesProduits.php");

  }else {
    Session::getSession()->addMessages('danger', $erreurs);
    Site::redirection('modificationProduit.php?id='.$product->idProduit);
  }
}

?>

<div class="row py-2 bg-info mw-100">
  <div class="col-sm-2 mx-2">
        <?php echo '<img style="max-width: 100px; max-height: 100px;" src="data:image/jpeg;base64,'.base64_encode( $product->img ).'"/>'; ?>
    </div>
    <div class="col text-white">
        vendu par : <?php echo $user->nom.' '.$user->prenom; ?>
    </div>
    
</div>

<div class="w-100 d-flex justify-content-center">
  <form class="p-2 w-75" action="" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
      <label for="productName" class="col-sm-4 col-form-label">Nom du produit :</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="productName" name="productName" placeholder=<?php echo $product->nom; ?>>
      </div>
    </div>

    <div class="form-group row">
      <label for="categorie" class="col-sm-4 col-form-label">Catégorie :</label>
      <div class="col-sm-8">
        <select class="custom-select" id="categorie" name="categorie">
          <option disabled selected value> choisi une catégorie</option>
          <option value="livres" <?php echo $product->categorie == "livres" ? "selected" :"";?> >Livres</option> 
          <option value="musique" <?php echo $product->categorie == "musique" ? "selected" :"";?> >Musique</option> 
          <option value="vetements" <?php echo $product->categorie == "vetements" ? "selected" :"";?> >Vêtements</option> 
          <option value="sport" <?php echo $product->categorie == "sport" ? "selected" :"";?> >Sports et loisirs</option> 
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="description" class="col-sm-4 col-form-label">Description :</label>
      <div class="col-sm-8">
        <textarea class="form-control" id="description" name="description"><?php echo $product->description; ?></textarea>
      </div>
    </div>

    <div class="form-group row">
      <div class="input-group col-sm-4">
        <div class="input-group-prepend">
            <label class="input-group-text">Caractéristiques</label>
          </div>
        <select class="custom-select" id="selectCara">
          <option selected></option>
          <?php foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { 
            echo '<option value="'.$cara->nom.'">'.$cara->nom.'</option>';
          }?>
        </select>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" id="caraAdd" type="button"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" id="caraDel" type="button"><i class="fas fa-minus-circle"></i></button>
        </div>
      </div>
    </div>
    
    <div class="form-group row col-sm-12">
      <?php foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { ?>
      <div class="input-group col-sm-3 mb-1 br-1" id="caraChoix_<?php echo $cara->nom; ?>" style="display: none;">
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $cara->nom;?></button>
          <div class="dropdown-menu">
          <?php   
            foreach (Site::getDatabase()->requete("SELECT choix.nom, choix.idChoix FROM CaraChoix as choix JOIN Carateristiques AS cara ON choix.idCara = cara.idCara  WHERE  cara.idCara = ?", [$cara->idCara]) as $choix) {


              $selected = Site::getDatabase()->requete('SELECT * FROM ChoixDispoProduits WHERE idChoix = '.$choix->idChoix.' AND idProduit = '.$product->idProduit)->fetch();
              $selected = !empty($selected)?'checked':'';

              echo '<a class="dropdown-item"><input type="checkbox" name="'.$cara->nom.'_'.$choix->nom.'" value="'.$choix->nom.'" '.$selected.' >'.$choix->nom.'</a>';
            } 
          ?>
          </div>
        </div>
      </div>
      
      <?php } ?>
    </div>

    <div class="form-group row">
      <div class="col-sm-6">
        <div class="row">
          <label for="price" class="col-sm-4 col-form-label">Prix :</label>
          <div class="col-sm-8">
            <input type="number" step="0.01" class="form-control" name="price" placeholder=<?php echo $product->prix; ?>>
          </div>
        </div>
      </div>
      
      <div class="col-sm-6">
        <div class="row">
          <label for="price" class="col-sm-4 col-form-label">Quantité :</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" name="quantity" placeholder=<?php echo $product->quantity; ?>>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-8 offset-sm-4">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="img" name="img">
          <label class="custom-file-label" for="img">Importer une image de produit</label>
        </div>
      </div>
    </div>    

    <button type="submit" class="btn btn-success offset-4 col-4 offset-md-9 mr-auto col-md-3">Modifier le produit</button>
    </form>
</div>

<?php include "footer.php" ?>



