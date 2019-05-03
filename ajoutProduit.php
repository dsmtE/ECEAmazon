<?php include "header.php";

if( !$logged) {
  $this->session->addMessage('danger', 'tu n\'est pas connecté');
  Site::redirection('connexion.php');
}

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on recoi des données
	$erreurs = array();
  	$db = Site::getDatabase();
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
	<form action="" method="POST" class="p-2 w-75">

		<div class="form-group row">
			<label for="inputProductName" class="col-sm-4 col-form-label">Nom du produit :</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="inputProductName" name="inputProductName" placeholder="Nom">
			</div>
		</div>

		<div class="form-group row">
			<label for="inputCategorie" class="col-sm-4 col-form-label">Catégorie :</label>
			<div class="col-sm-8">
				<select class="custom-select" id="inputCategorie" name="inputCategorie">
					<option selected>Choisir la catégorie</option>
					<option value="livres">Livres</option>
					<option value="musique">Musique</option>
					<option value="mode">Vêtements</option>
					<option value="sports">Sports et loisirs</option>
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputDescription" class="col-sm-4 col-form-label">Description :</label>
			<div class="col-sm-8">
				<textarea class="form-control" id="inputDescription" name="inputDescription"></textarea>
			</div>
		</div>

		<div class="form-group row">
			<div class="input-group col-sm-4">
				<div class="input-group-prepend">
    				<label class="input-group-text">Caractéristiques</label>
  				</div>
				<select class="custom-select" id="carac">
					<option selected></option>
					<?php foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { 
						echo '<option value="'.$cara->nom.'">'.$cara->nom.'</option>';
					}?>
				</select>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary caraAdd" type="button"><i class="fas fa-plus-circle"></i></button>
				</div>
			</div>
		</div>
		
		<div class="form-group row col-sm-8 offset-sm-2">
			
			<?php foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { ?>
			<div class="input-group col-sm-3 mb-1" style="visibility: show;">
				<div class="input-group-prepend">
					<?php echo '<label class="input-group-text" for="inputGroup_'.$cara->nom.'">'.$cara->nom.'</label>'; ?>
				</div>
				<select class="custom-select" id="inputGroupSelect01">

				<?php 
				//foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $choix) { 
				//}

				?>
				
					<option selected>...</option>
					<option value="S">S</option>
					<option value="M">M</option>
					<option value="L">L</option>
				</select>
			</div>
			
			<?php } ?>
		</div>

		<div class="form-group row">
			<label for="price" class="col-sm-4 col-form-label">Prix :</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="price" name="price" placeholder="--,--">
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