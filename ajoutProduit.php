<?php include "header.php";

if( !$logged) {
  $this->session->addMessage('danger', 'tu n\'est pas connecté');
  Site::redirection('connexion.php');
}

$db = Site::getDatabase();

$user = Session::getSession()->read("user");

if(!empty($_POST)) { // si on recoi des données
	echo 'test';
}

?>

<div class="row mw-100">
	<div class="col bg-info" id="banniere"> <!--placeholder SQL-->
		<div class="row">
			<div class="col-sm-2 text-white" id="NomPrenom">
				<?php echo $user->nom.' '.$user->prenom; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-1" id="iconUser" style="padding : 0 0 3em 5em"> <!--placeholder SQL-->
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


		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-4">
					<select class="custom-select" id="carac">
						<option selected>Caractéristiques</option>
						<option value="taille">Taille</option>
						<option value="couleur">Couleur</option>
						<!-- placeholder SQL-->
					</select>
				</div>
			</div>
			<div class="row mt-4 justify-content-center">
				<div class="input-group mb-3 col-sm-3"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect01">Taille</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-sm-9" id="inputGroupSelect01">
						<option selected>...</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
					</select>
				</div>
				<div class="input-group mb-3 col-sm-3" style="visibility: hidden;"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect02">Couleur</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-sm-9" id="inputGroupSelect02">
						<option selected>...</option>
						<option value="R">Rouge</option>
						<option value="B">Bleu</option>
						<option value="J">Jaune</option>
					</select>
				</div>
				<div class="input-group mb-3 col-sm-3" style="visibility: hidden;"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect03">Genre</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-sm-9" id="inputGroupSelect03">
						<option selected>...</option>
						<option value="rap">Rap</option>
						<option value="jazz">Jazz</option>
						<option value="classique">Classique</option>
					</select>
				</div>
			</div>
			<div class="row mt-4 justify-content-center"><!--placeholderSQL-->
				<div class="input-group mb-3 col-sm-3" style="visibility: hidden;"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect11">Taille</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-9" id="inputGroupSelect11">
						<option selected>...</option>
						<option value="S">S</option>
						<option value="M">M</option>
						<option value="L">L</option>
					</select>
				</div>
				<div class="input-group mb-3 col-sm-3" style="visibility: hidden;"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect22">Couleur</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-sm-9" id="inputGroupSelect22">
						<option selected>...</option>
						<option value="R">Rouge</option>
						<option value="B">Bleu</option>
						<option value="J">Jaune</option>
					</select>
				</div>
				<div class="input-group mb-3 col-sm-3" style="visibility: hidden;"> <!--placeholder SQL-->
					<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect33">Genre</label> <!--placeholder SQL-->
					</div>
					<select class="custom-select col-sm-9" id="inputGroupSelect33">
						<option selected>...</option>
						<option value="rap">Rap</option>
						<option value="jazz">Jazz</option>
						<option value="classique">Classique</option>
					</select>
				</div>
			</div>
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