<?php include "header.php" ?>

<div class="row justify-content-center">
	<div class="col-sm-6">
		<h1 class="float-left">Utilisateurs</h1>
		<select class="custom-select col-sm-8" multiple>
			<option selected>Sélectionner l'utilisateur désiré</option>
			<option value="id1">Jean Dupont</option> <!--plceholder SQL-->
			<option value="id2">Etienne Marcel</option>
			<option value="id3">Marc Henri</option>
		</select>
	</div>
	<div class="col-sm-6">
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
				<label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="telephone" placeholder="00 00 00 00 00">
				</div>
			</div>
			<div class="form-group row">
				<label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="adresse" placeholder="Adresse">
				</div>
			</div>
			<div class="form-group row">
				<label for="code postal" class="col-sm-2 col-form-label">Code postal</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="code postal" placeholder="00 000">
				</div>
			</div>
			<div class="form-group row">
				<label for="ville" class="col-sm-2 col-form-label">Ville</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="ville" placeholder="Ville">
				</div>
			</div>
			<div class="form-group row">
				<label for="pays" class="col-sm-2 col-form-label">Pays</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="pays" placeholder="Pays">
				</div>
			</div>
		</form>
	</div>
</div>

<?php include "footer.php"?>