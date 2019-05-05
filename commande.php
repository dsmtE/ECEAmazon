<?php include "header.php";

if(!$logged) {
	$session->addMessage('danger', 'Tu n\'es pas connecté');
	Site::redirection('connexion.php');
}

$session = Session::getSession();
$user = $session->read("user");
$db = Site::getDatabase();
$userCB = $db->requete('SELECT * FROM CartesBancaires WHERE idUser = ?',[$user->idUser])->fetch();

if(empty(Session::getSession()->getPanierElems())){
    $session->addMessage('danger', 'Tu n\'a aucun article dans ton panier');
	Site::redirection('produit.php');
}

if(!empty($_POST)) {

	!isset($_POST['adresse']) || empty($_POST['adresse']) ? $_POST['adresse']          = isset($user->adresse) ? $user->adresse : null :"";
	!isset($_POST['codePostal']) || empty($_POST['codePostal']) ? $_POST['codePostal'] = isset($user->codePostal) ? $user->codePostal : null :"";
	!isset($_POST['ville']) || empty($_POST['ville']) ? $_POST['ville']                = isset($user->ville) ? $user->ville : null :"";
	!isset($_POST['pays']) || empty($_POST['pays']) ? $_POST['pays']                   = isset($user->pays) ? $user->pays : null :"";


	// si l'un des champ est toujours null
	if( $user->adresse == null || $user->codePostal == null || $user->ville == null || $user->pays == null) {

		$session->addMessage('danger', 'Tu n\'a pas complété  les champs de ton adresse');
		Site::redirection('compte.php');
	}


	switch ($_POST['typePaiementValue']) {
		case 'blockCard':

			!isset($_POST['cardNumber']) || empty($_POST['cardNumber']) ? $_POST['cardNumber']          = isset($userCB) ? $userCB->numero : null :"";

			!isset($_POST['date']) || empty($_POST['date']) ? $_POST['date']          = isset($userCB) ? $userCB->dateExpiration : null :"";

			!isset($_POST['securityCode']) || empty($_POST['securityCode']) ? $_POST['securityCode']          = isset($userCB) ? $userCB->codeSecurite : null :"";

			!isset($_POST['typeCarte']) || empty($_POST['typeCarte']) ? $_POST['typeCarte']          = isset($userCB) ? $userCB->type : null :"";

			!isset($_POST['nameCard']) || empty($_POST['nameCard']) ? $_POST['nameCard']          = isset($user) ? $$user->nom : null :"";

			//print_r($_POST);

			// si l'un des champ est toujours null
			if( empty($_POST['cardNumber']) || empty($_POST['date']) || empty($_POST['securityCode']) || empty($_POST['typeCarte']) || empty($_POST['nameCard'])) {
				$session->addMessage('danger', 'Tu n\'a pas complété tous les champ de la carte bancaire');
				Site::redirection('commande.php');
			}else {
				if(!$userCB) {
					$db->requete('INSERT INTO CartesBancaires (idUser, numero, codeSecurite, dateExpiration, type) VALUES ('.$user->idUser.', '.$_POST['cardNumber'].', '.$_POST['securityCode'].', "'.$_POST['date'].'-00", "'.$_POST['typeCarte'].'")');
					$session->addMessage('info', 'La carte a été ajoutée à la base de données');
				}
				
			}

			break;
		case 'paypal':
			if( empty($_POST['inputEmailPP']) || empty($_POST['inputPasswordPP'])) {
				$session->addMessage('danger', 'Tu n\'a pas complété tous les champs pour te connecter à paypal');
				Site::redirection('commande.php');
			}else {
				//on suppose que l'on verifie à ce moment si ce sont les bon identifiant
				$session->addMessage('success', 'identifant PayPal validé');
			}
			break;
		case 'chqCadeau':
			if( empty($_POST['numChq'])) {
				$session->addMessage('danger', 'Tu n\'a pas renseigné de code chèque cadeau');
				Site::redirection('commande.php');
			}else {
				//on suppose que l'on verifie à ce moment si le cheque cadeau est valide
				$session->addMessage('success', 'Chèque cadeau valide');
			}
			break;

		default:
			//nothing
			break;
	}

	//si il n'y a pas eu d'erreur ou de redirection jusque là 
	$session->passerCommande($db);
	Site::redirection('index.php');
}

?>

<div class="row">
</div>
<form action="" method="POST" id="formulaireGen">
	<div class="row m-4">
		<div class="col-lg-2 mr-5">
			<h2 style="text-align: center; color: #1EC4E9">Informations de livraison</h2>
		</div>
		<div class="col-sm-9">
			<div class="form-group row">
				<label for="inputPostal" class="col-sm-2 col-form-label">Adresse : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="adresse" placeholder=<?php echo isset($user->adresse) ? "'".$user->adresse."'" : null; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPostal" class="col-sm-2 col-form-label">Code postal : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="codePostal" placeholder=<?php echo '"'.isset($user->codePostal) ? $user->codePostal : null.'"'; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCity" class="col-sm-2 col-form-label">Ville :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="ville" placeholder=<?php echo '"'.isset($user->ville) ? $user->ville : null.'"'; ?>>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCountry" class="col-sm-2 col-form-label">Pays :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="pays" placeholder=<?php echo '"'.isset($user->pays) ? $user->pays : null.'"'; ?>>
				</div>
			</div>
		</div>
	</div>

	<div class="row m-4">
		<div class="col-lg-2 mr-5">
			<h2 style="text-align: center; color: #1EC4E9">Informations de paiement</h2>
		</div>
		<div class="col-sm-2 mt-3 mr-1">
			<div class="input-group mb-3">
				<select class="custom-select" id="typePaiement">
					<option disabled selected value>Mode de paiement</option>
					<option value="blockCard" >Carte bancaire</option>
					<option value="paypal"> PayPal</option>
					<option value="chqCadeau"> Chèque cadeau</option>
				</select>
			</div>
		</div>

		<div class="col-sm formulaire">
			<div class="blockCard subForm" class="col-sm" style="display:none ; position: absolute;"> <!-- Bloc pour les CB-->
				<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">Carte bancaire</h3>
					<div class="form-group row mt-3">
						<label for="inputCard" class="col-sm-2 col-form-label mt-3">Numéro de carte :</label>
						<div class="col-sm-4">
							<input type="number" class="form-control mt-3" name="cardNumber" placeholder=<?php echo '"'.($userCB ? $userCB->numero :'XXXX-XXXX-XXXX-XXXX').'"' ; ?>>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="dateCard" class="col-sm-4 col-form-label mt-3">Date d'expiration :</label>
								<input class="form-control col-6" type="month" name="date" style="display: inline-block;" value=<?php echo '"'.($userCB ? substr($userCB->dateExpiration,0,-3) :'2019-01').'"' ; ?>>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="nameCard" class="col-sm-2 col-form-label">Nom du titulaire :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="nameCard" placeholder=<?php echo '"'.$user->nom.'"';?> value=<?php echo '"'.$user->nom.'"';?>>
						</div>
						<div class="input-group col-4 offset-1">
							<select class="custom-select" name="typeCarte">
								<option disabled <?php echo !$userCB ? 'selected' :"";?> value>Type de carte</option>
								<option value="visa" <?php echo $userCB  &&  $userCB->type == "visa" ? "selected" :"";?> >Visa</option>
								<option value="american" <?php echo $userCB  &&  $userCB->type == "american" ? "selected" :"";?> >American</option>
								<option value="master" <?php echo $userCB  &&  $userCB->type == "master" ? "selected" :"";?> >Master</option>
							</select>
						</div>
					</div>
					<div class="form-group row mt-4">
						<label for="securityCode" class="col-sm-2 col-form-label">Code de sécurité:</label>
						<div class="col-2">
							<input type="number" class="form-control" name="securityCode"  placeholder=<?php echo '"'.($userCB ? $userCB->codeSecurite :'***').'"' ; ?>>
						</div>
						<div class="col-5 ml-auto">
							<button type="submit" class="btn btn-success" style=" width : 8em;" >Valider</button>
						</div>
					</div>
					
			</div>
			<div class="paypal subForm" style="display:none; position: absolute; width : 50em; "> <!--Bloc Paypal-->
				<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">PayPal</h3>
				<div class="col-sm mt-3">
					<p style="text-align:center; font-size: 1.3em;">Connexion au compte Paypal</p>
						<div class="form-group row">
							<label for="inputEmailPP" class="col-sm-3 col-form-label">Adresse mail :</label>
							<div class="col-sm-9">
								<input type="paypalMail" class="form-control" name="inputEmailPP" placeholder="Email">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPasswordPP" class="col-sm-3 col-form-label">Mot de passe :</label>
							<div class="col-sm-9">
								<input type="paypalPassword" class="form-control" name="inputPasswordPP" placeholder="*******">
							</div>
						</div>
						<button type="submit" class="btn btn-success" style="float: right; width : 8em;" id="validerPaypal">Valider</button>
				</div>
			</div>
			<div class="chqCadeau subForm" style="display:none ;">
				<h3 class="pt-3 pb-3"style="font-size : 1.5em; text-align: center;">Chèque cadeau</h3>
				<div class="col-sm mt-3">
						<div class="form-group row justify-content-center">
							<label for="numChq" class="col-sm-4 col-form-label mb-2"> Veuillez entrer le code chèque cadeau :</label>
							<div class="col-sm-4">
								<input type="number" name="numChq" class="form-control" placeholder="123456">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-md-2">
								<button type="submit" class="btn btn-success" id="validerChq">Valider</button>
								
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<input id="typePaiementValue" name="typePaiementValue" value type="hidden">
</form>


<?php include "footer.php"?>