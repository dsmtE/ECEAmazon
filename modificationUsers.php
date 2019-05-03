<?php 
include "header.php";
$session = Session::getSession();

if(!$admin) {
	$session->addMessage('danger', 'tu n\'es pas administrateur');
	Site::redirection('connexion.php');
}
$db = Site::getDatabase();
if(!empty($_POST)) { // si on recoi des données

	$erreurs = array();

}
$utilisateurs = $db->requete('SELECT * FROM Utilisateurs');


if(isset($_GET['selectedUser'])) {
	$idSelected = $_GET['selectedUser'];
	$option = $db->requete('SELECT * FROM Utilisateurs WHERE idUser = ?',[$idSelected]);
	$userSelected = $option->fetch();

}
else{
	$userSelected = 0;
}

?>

<div class="row justify-content-center" style="max-width: 100%">
	<div class="col-sm-6">
		<h1 class="row offset-2 mt-4 mb-5" style="color: rgb(23,162,184);" >Utilisateurs <i class="fas fa-users ml-3 mt-2 text-secondary"></i></h1>
		<div class="row justify-content-center">
			<select class="custom-select col-sm-8" style="height : 4em;" id="selectedUser">
				<option class="text-secondary" style="font-weight : bold;">Sélectionner l'utilisateur à modifier</option>
				<?php
				while($user = $utilisateurs->fetch()){
					if($user == $userSelected){
						echo'<option value="'.$user->idUser.'" selected>'.$user->prenom.' '.$user->nom.'</option>';}
					else{
					echo'<option value="'.$user->idUser.'" >'.$user->prenom.' '.$user->nom.'</option>';}
				} ?>
			</select>
		</div>
	</div>
	<div class="col-sm-6 mt-3">
		<form style="padding: 10px;">
			<div class="form-group row">
				<label for="nom" class="col-sm-2 col-form-label">Nom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="nom" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->nom.'"';} echo'placeholder = "Nom"'; ?> >
				</div>
			</div>
			<div class="form-group row">
				<label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="prenom" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->prenom.'"';} echo'placeholder = "Prénom"'; ?>> 
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->mail.'"';} echo'placeholder = "Email"'; ?> >
				</div>
			</div>
			<div class="form-group row">
				<label for="mot de passe" class="col-sm-2 col-form-label">Mot de passe</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="mot de passe" placeholder="Saisissez le nouveau mot de passe">
				</div>
			</div>
			<div class="form-group row">
				<label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="telephone" 
					<?php if($userSelected){echo'placeholder="0'.$userSelected->tel.'"';} echo'placeholder = "00 00 00 00 00"'; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="adresse" 
					<?php if($userSelected){ 
						if($userSelected->adresse)
							{echo'placeholder="'.$userSelected->adresse.'"';}} 
						echo'placeholder = "Adresse"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="code postal" class="col-sm-2 col-form-label">Code postal</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="code postal"
						<?php if($userSelected){ 
						if($userSelected->codePostal)
							{echo'placeholder="'.$userSelected->codePostal.'"';}} 
						echo'placeholder = "00000"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="ville" class="col-sm-2 col-form-label">Ville</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="ville"
						<?php if($userSelected){ 
						if($userSelected->ville)
							{echo'placeholder="'.$userSelected->ville.'"';}} 
						echo'placeholder = "Ville"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="pays" class="col-sm-2 col-form-label">Pays</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="pays"
						<?php if($userSelected){ 
						if($userSelected->pays)
							{echo'placeholder="'.$userSelected->pays.'"';}} 
						echo'placeholder = "Pays"'; ?>>
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