<?php include "header.php";

if( !$admin) {
  $this->session->addMessage('danger', 'tu n\'es pas administrateur');
  Site::redirection('connexion.php');
}

?>

<div class="row justify-content-center" style="max-width: 100%">
	<div class="col-sm-6">
		<h1 class="row offset-2 mt-4 mb-5" style="color: rgb(23,162,184);" >Utilisateurs <i class="fas fa-users ml-3 mt-2 text-secondary"></i></h1>
		<div class="row justify-content-center">
			<select class="custom-select col-sm-8" style="height : 8em;" multiple>
				<option class="text-secondary" style="font-weight : bold;" selected>Sélectionner l'utilisateur désiré</option>
				<option value="id1">Jean Dupont</option> <!--placeholder SQL-->
				<option value="id2">Etienne Marcel</option> <!--placeholder SQL-->
				<option value="id3">Marc Henri</option> <!--placeholder SQL-->
			</select>
		</div>
	</div>
	<div class="col-sm-6 mt-3">
		<form style="padding: 10px;">
			<div class="form-group row">
				<label for="nom" class="col-sm-2 col-form-label">Nom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nom" placeholder="Nom"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="prenom" placeholder="Prénom"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" placeholder="Email"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="mot de passe" class="col-sm-2 col-form-label">Mot de passe</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="mot de passe" placeholder="Mot de passe"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="telephone" placeholder="00 00 00 00 00"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="adresse" placeholder="Adresse"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="code postal" class="col-sm-2 col-form-label">Code postal</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="code postal" placeholder="00 000"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="ville" class="col-sm-2 col-form-label">Ville</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="ville" placeholder="Ville"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="form-group row">
				<label for="pays" class="col-sm-2 col-form-label">Pays</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="pays" placeholder="Pays"> <!--placeholder SQL-->
				</div>
			</div>
			<div class="row">
				<div class="col">
					<button type="submit" class="btn btn-primary offset-4 col-4 offset-md-9 mr-auto col-md-3">Modifier</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php include "footer.php"?>