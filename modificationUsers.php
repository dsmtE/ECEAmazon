<?php 
include "header.php";
$session = Session::getSession();

if(!$admin) {
	$session->addMessage('danger', 'Tu n\'es pas administrateur');
	Site::redirection('connexion.php');
}

$db = Site::getDatabase();

$utilisateurs = $db->requete('SELECT * FROM Utilisateurs');

if(isset($_GET['selectedUser'])) {
	$idSelected = $_GET['selectedUser'];
	$userSelected = $db->requete('SELECT * FROM Utilisateurs WHERE idUser = ?',[$idSelected])->fetch();
	
	if(empty($userSelected)) {
		$session->addMessage('danger', 'Cet id ne correspond à aucun utilisateur');
		Site::redirection('modificationUsers.php');
	}
}
else{
	$userSelected = null;
}

if(!empty($_POST) && $userSelected != null) { // si on recoi des données

	$erreurs = array();

	!isset($_POST['mdp']) || empty($_POST['mdp']) ? $_POST['mdp'] = $userSelected->mdp : $_POST['mdp'] =  password_hash($_POST['mdp'], PASSWORD_BCRYPT);
	!isset($_POST['nom']) || empty($_POST['nom']) ? $_POST['nom']                      = $userSelected->nom :"";
	!isset($_POST['prenom']) || empty($_POST['prenom']) ?$_POST['prenom']              = $userSelected->prenom :"";
	!isset($_POST['mail']) || empty($_POST['mail']) ? $_POST['mail']                   = $userSelected->mail :"";
	!isset($_POST['telephone']) || empty($_POST['telephone']) ? $_POST['telephone']    = $userSelected->tel :"";
	!isset($_POST['adresse']) || empty($_POST['adresse']) ? $_POST['adresse']          = isset($userSelected->adresse) ? $userSelected->adresse : null :"";
	!isset($_POST['codePostal']) || empty($_POST['codePostal']) ? $_POST['codePostal'] = isset($userSelected->codePostal) ? $userSelected->codePostal : null :"";
	!isset($_POST['ville']) || empty($_POST['ville']) ? $ $_POST['ville']              = isset($userSelected->ville) ? $userSelected->ville : null  :"";
	!isset($_POST['pays']) || empty($_POST['pays']) ? $_POST['pays']                   = isset($userSelected->pays) ? $userSelected->pays : null  :"";


	// test nom
	if(!Validation::isAlphanumeric($_POST['nom']) ) {
		array_push($erreurs, "Le nouveau nom n'est pas valide");
	}
	// test prénom
	if(!Validation::isAlphanumeric($_POST['prenom']) ) {
		array_push($erreurs, "Le nouveau prenom n'est pas valide");
	}  

	// test mail
	if(!Validation::isMail($_POST['mail']) ) {
		array_push($erreurs, "Le nouvel mail n'est pas valide");
	} 

 	// test code postal
	if($_POST['codePostal'] != null && !Validation::isAlphanumeric($_POST['codePostal']) ) {
		array_push($erreurs, "Le nouveau code postal n'est pas valide");
	}      

 	// test ville
	if($_POST['ville'] != null && !Validation::isAlphanumeric($_POST['ville']) ) {
		array_push($erreurs, "La nouvelle ville n'est pas valide");
	}      

 	// test pays
	if($_POST['pays'] != null && !Validation::isAlphanumeric($_POST['pays']) ) {
		array_push($erreurs, "Le nouveau pays n'est pas valide");
	}    

	if(empty($erreurs)) { // il n'y a pas eu d'erreurs on procède à l'inscription

    	$db->requete('UPDATE Utilisateurs SET nom = ?, prenom = ?, mail = ?, tel = ?, mdp = ?, adresse = ?, codePostal = ?, ville = ?, pays = ? WHERE idUser = ?', [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['telephone'], $_POST['mdp'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['pays'],  $userSelected->idUser]);

    	Session::getSession()->addMessage('success', 'Modification de l\'utilisateur effectuée');
    	Site::redirection("index.php");

  }else {
    Session::getSession()->addMessages('danger', $erreurs);
    Site::rechargerPage();
  }

}

?>

<div class="row justify-content-center" style="max-width: 100%">
	<div class="col-sm-6">
		<h1 class="row offset-2 mt-4 mb-5" style="color: rgb(23,162,184);" >Utilisateurs <i class="fas fa-users ml-3 mt-2 text-secondary"></i></h1>
		
		<div class="row justify-content-center">
			<select class="custom-select col-sm-8" style="height : 4em;" id="selectedUser">
				<option disabled selected class="text-secondary" style="font-weight : bold;">Sélectionner l'utilisateur à modifier</option>
				<?php
				while($user = $utilisateurs->fetch()){
					if($user == $userSelected){
						echo'<option value="'.$user->idUser.'" selected>'.$user->prenom.' '.$user->nom.'</option>';}
					else{
					echo'<option value="'.$user->idUser.'" >'.$user->prenom.' '.$user->nom.'</option>';}
				} ?>
			</select>
		</div>

		<div class="row justify-content-center">
		<?php 
		if ($userSelected) {
			echo '<img class="mt-3" style="max-width: 200px; max-height: 200px;" src="data:image/jpeg;base64,'.base64_encode( $userSelected->img ).'"/>'; 
		}
		?>
		</div>

	</div>
	<div class="col-sm-6 mt-3">
		<form class="p-2 w-75" action="" method="POST" enctype="multipart/form-data">
			<div class="form-group row">
				<label for="nom" class="col-sm-3 col-form-label">Nom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="nom" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->nom.'"';} echo'placeholder = "Nom"'; ?> >
				</div>
			</div>
			<div class="form-group row">
				<label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="prenom" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->prenom.'"';} echo'placeholder = "Prénom"'; ?>> 
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-sm-3 col-form-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" name="mail" 
					<?php if($userSelected){echo'placeholder="'.$userSelected->mail.'"';} echo'placeholder = "Email"'; ?> >
				</div>
			</div>
			<div class="form-group row">
				<label for="mot de passe" class="col-sm-3 col-form-label">Mot de passe</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" name="mdp" placeholder="Saisissez le nouveau mot de passe">
				</div>
			</div>
			<div class="form-group row">
				<label for="telephone" class="col-sm-3 col-form-label">Téléphone</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="telephone" 
					<?php if($userSelected){echo'placeholder="0'.$userSelected->tel.'"';} echo'placeholder = "00 00 00 00 00"'; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="adresse" class="col-sm-3 col-form-label">Adresse</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="adresse" 
					<?php if($userSelected){ 
						if($userSelected->adresse)
							{echo'placeholder="'.$userSelected->adresse.'"';}} 
						echo'placeholder = "Adresse"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="code postal" class="col-sm-3 col-form-label">Code postal</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="codePostal"
						<?php if($userSelected){ 
						if($userSelected->codePostal)
							{echo'placeholder="'.$userSelected->codePostal.'"';}} 
						echo'placeholder = "00000"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="ville" class="col-sm-3 col-form-label">Ville</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ville"
						<?php if($userSelected){ 
						if($userSelected->ville)
							{echo'placeholder="'.$userSelected->ville.'"';}} 
						echo'placeholder = "Ville"'; ?>>
					</div>
				</div>
				<div class="form-group row">
					<label for="pays" class="col-sm-3 col-form-label">Pays</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="pays"
						<?php if($userSelected){ 
						if($userSelected->pays)
							{echo'placeholder="'.$userSelected->pays.'"';}} 
						echo'placeholder = "Pays"'; ?>>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<button type="submit" <?php if (!$userSelected) { echo 'disabled'; } ?> class="btn btn-primary offset-4 col-4 offset-sm-8 mr-auto col-sm-3">Modifier</button>
					</div>
				</div>

			</form>
		</div>
	</div>

	<?php include "footer.php"?>