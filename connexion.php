<?php 
	require_once 'phpClass/autoloader.php';
	$session = Session::getSession();
		
	if (Site::getUser()->isConnected()) {
		$session->addMessage('info', "tu es déjà connecté");
		Site::redirection('index.php');
	}
	if(!empty($_POST)) { // si on recoi des données

		$erreurs = array();
		$db = Site::getDatabase();

		// test mail
		if( !isset($_POST['mail']) || empty($_POST['mail']) ) {
			array_push($erreurs, "tu n\'a pas rentré de mail");
		} else {
			if( !Validation::isMail($_POST['mail']) ) {
				array_push($erreurs, "ton mail n'est pas valide");
			}	
		}

		// test mdp
		if( !isset($_POST['mdp']) || empty($_POST['mdp']) ) {
			array_push($erreurs, "tu n\'a pas rentré de mot de passe");
		} else {
			if( !Validation::isAlphanumeric($_POST['mdp']) ) {
				array_push($erreurs, "ton mdp n'est pas valide il doit être composé uniquement de caractères alpha numérique");
			}	
		}
		


		if(empty($erreurs)) { // il n'y a pas eu d'erreurs
			$user = Site::getUser()->compteExistantbyMail($_POST['mail']);

			if ($user) {
				if (Site::getUser()->isValidated($_POST['mail'])) {
					if (password_verify($_POST['mdp'], $user->mdp)) {
					//if (password_verify($_POST['mdp'], $user->mdp)) {
						Site::getUser()->connectionUser($user->idUser);
						$session->addMessage('success', "tu es bien connecté");
						Site::redirection('index.php');
					}else {
						$session->addMessage('danger', "ton mot de passe est invalide");
					}
				} else {
						$session->addMessage('info', "ton compte n'a pas été validé");	
				}
			} else {
				$session->addMessage('danger', "Ce compte n'existe pas");
			}

		
		}else {
			$session->addMessages('danger', $erreurs);
		}
		
	}

include "header.php";
?>


<div class="container-fluid col">
	<div class="row justify-content-center m-1"> <!--Bloc global-->
		<div class=" col-5  align-self-center ">
			<div class="row"><!-- Sous bloc logo/titre-->
				<div class="col-3"><!-- Sous colonne logo-->
					<i alt="LogoECEAmazon" class="fab fa-artstation fa-7x" style="float:left; margin :10px;"></i>
				</div>
				<div class="col-8" style="top: 1em;"><!-- Sous colonne titre/sous-titres-->
					<div class="row"><!--sous bloc titre-->
						<div class="col">
							<h1 class="text-center" style="font-size:3em; font-style : bold;color: rgb(23,162,184); ">ECEAmazon</h1>
						</div>
					</div>
					<div class="row"><!-- Sous bloc sous titre-->
						<div class="col">
							<h2 class="text-center" style="font-size : 1.6em; font-style: italic;color: rgb(23,162,184,0.6);">N°1 de la vente en ligne</h2>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="row justify-content-center" style="padding : 15% 0%">
		<div class="col-sm-8">
			<form action="" method="POST">
				<div class="form-group row">
					<label for="inputEmail" class="col-sm-2 col-form-label">Adresse mail :</label>
					<div class="col-sm-10">
						<input type="email" name='mail' class="form-control" id="inputEmail" placeholder="Email">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe : </label>
					<div class="col-sm-10">
						<input type="password" name='mdp' class="form-control" id="inputPassword" placeholder="Mot de passe">
					</div>
				</div>
				<div class="form-group row">
					<button type="submit" class="btn btn-primary">Se connecter</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include "footer.php"?>
