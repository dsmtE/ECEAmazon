<?php include "header.php";

if( !$logged) {
  Session::getSession()->addMessage('danger', 'Tu n\'es pas connecté');
  Site::redirection('connexion.php');
}

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on recoi des données
	$erreurs = array();

  	if( !isset($_POST['productName']) || empty($_POST['productName']) ) {
    	array_push($erreurs, "Tu n\'a pas rentré de nom de produit");
  	} else {
	    /*if( !Validation::isAlphanumeric($_POST['productName']) ) {
	      array_push($erreurs, "ton nom n'est pas valide");
	    }*/
  	}

  	if( !isset($_POST['categorie']) || empty($_POST['categorie']) ) {
    	array_push($erreurs, "Tu n\'a pas choisi de catégorie");
  	}

  	if( !isset($_POST['description']) || empty($_POST['description']) ) {
    	array_push($erreurs, "Tu n\'a pas ecrit de description");
  	}

  	if( !isset($_POST['price']) || empty($_POST['price']) ) {
    	array_push($erreurs, "Tu n\'a pas rentré de prix");
  	}

  	!isset($_POST['quantity']) || empty($_POST['quantity']) ? $_POST['quantity'] = 1 : "";

  	$img = $_FILES['img']['tmp_name'];
// test img
  	if(!isset($img) || empty($img) )  {
  		array_push($erreurs, "Tu n'a pas selectionné d'image pour le produit");
  	}else {
  		if( !getimagesize( $img )) {
  			array_push($erreurs, "Le fichier choisi n'est pas une image");
  		}
  	}

	if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

		//ajout du produit
		Site::getDatabase()->requete('INSERT INTO Produits (nom, categorie, idVendeur, description, prix, quantity, img) 
			VALUES ("'.
			$_POST['productName'].'", "'.
			$_POST['categorie'].'", '.
			$user->idUser.', "'.
			$_POST['description'].'", '.
			$_POST['price'].", ".
			$_POST['quantity'].', "'.
			addslashes(file_get_contents($img)).'")');

		$idProduct = Site::getDatabase()->getLastInsertId();

		//ajout choix dispo produits
		foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { 
		 	foreach (Site::getDatabase()->requete("SELECT choix.idChoix, choix.nom FROM CaraChoix as choix JOIN Carateristiques AS cara ON choix.idCara = cara.idCara  WHERE  cara.idCara = ?", [$cara->idCara]) as $choix) {

		 		if(isset($_POST[$cara->nom."_".$choix->nom])) {
		 			Site::getDatabase()->requete('INSERT INTO ChoixDispoProduits (idProduit, idChoix) VALUES ('.$idProduct.', '.$choix->idChoix.')');
		 		}
		 	}
		}

		Session::getSession()->addMessage('success', "Ton produit a bien été créé");
		Site::redirection('ajoutProduit.php');

	}else {
		Session::getSession()->addMessages('danger', $erreurs);
		Site::redirection('ajoutProduit.php');
		exit();
	}
}

?>

<div class="row mw-100">
	<div class="col bg-info" id="banniere">
		<div class="row">
			<div class="col-sm-2 text-white" id="NomPrenom">
				<?php echo $user->nom.' '.$user->prenom; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-1" id="iconUser">
				<i class="far fa-user-circle fa-6x" style="color :white;"></i>
			</div>
		</div>
	</div>
</div>

<div class="w-100 d-flex justify-content-center">
	<form class="p-2 w-75" action="" method="POST" enctype="multipart/form-data">
		<div class="form-group row">
			<label for="productName" class="col-sm-4 col-form-label">Nom du produit :</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="productName" name="productName" placeholder="Nom">
			</div>
		</div>

		<div class="form-group row">
			<label for="categorie" class="col-sm-4 col-form-label">Catégorie :</label>
			<div class="col-sm-8">
				<select class="custom-select" id="categorie" name="categorie">
					<option disabled selected value> choisi une catégorie</option>
					<option value="livres">Livres</option>
					<option value="musique">Musique</option>
					<option value="vetements">Vêtements</option>
					<option value="sport">Sports et loisirs</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="description" class="col-sm-4 col-form-label">Description :</label>
			<div class="col-sm-8">
				<textarea class="form-control" id="description" name="description"></textarea>
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
						foreach (Site::getDatabase()->requete("SELECT choix.nom FROM CaraChoix as choix JOIN Carateristiques AS cara ON choix.idCara = cara.idCara  WHERE  cara.idCara = ?", [$cara->idCara]) as $choix) {
							echo '<a class="dropdown-item"><input type="checkbox" name="'.$cara->nom.'_'.$choix->nom.'" value="'.$choix->nom.'">'.$choix->nom.'</a>';
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
						<input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="--.--">
					</div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="row">
					<label for="price" class="col-sm-4 col-form-label">Quantité :</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" id="price" name="quantity" placeholder="--">
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

		<button type="submit" class="btn btn-success offset-4 col-4 offset-md-9 mr-auto col-md-3">Ajouter le produit</button>
    </form>
</div>

<?php include "footer.php"; ?>