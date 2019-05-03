<?php include "header.php";

if(!$logged) {
	$this->session->addMessage('danger', 'tu n\'es pas connecté');
	Site::redirection('connexion.php');
}
$user = Session::getSession()->read("user");


if(isset($_GET['typePaiement'])){
	$paiement = $_GET['typePaiement'];
	switch($paiement){
		case "blockCard" : $popUpCB = " "; break;
		case "paypal" : $popUPPaypal = " "; break;
		case "chqCadeau" : $popUpChq = " "; break;
	}
	print_r($_GET);
}
else{
	$popUpCB = "hidden";
	$popUpPaypal = "hidden";
	$popUpChq = "hidden";
}

?>

<div class="row">
	<div class="col bg-info" id="banniere"> <!--placeholder SQL-->
		<div class="row">
			<div class="col-2 text-white" id="NomPrenom" style="padding : 1.5em 0 1em 3em; font-size : 1.3em;">
				<?php echo $user->nom.' '.$user->prenom; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1" id="iconUser" style="padding : 0 0 2em 5em"> <!--placeholder SQL-->
				<i class="far fa-user-circle fa-6x" style="color :white;"></i>
			</div>
		</div>
	</div>
</div>
<div class="row m-4">
	<div class="col-lg-2 mr-5">
		<h2 style="text-align: center; color: #1EC4E9">Informations de livraison</h2>
	</div>
	<div class="col-sm-9">
		<form>
			<div class="form-group row">
				<label for="inputAddress" class="col-sm-2 col-form-label">Adresse :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputAddress" <?php if($user->adresse){
						echo 'placeholder="'.$user->adresse.'"';}
						else{
							echo 'placeholder="Adresse"';
						}?>>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6 offset-2">
					<input type="text" class="form-control" id="inputAddress2" placeholder="Complément d'adresse">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPostal" class="col-sm-2 col-form-label">Code postal : </label>
				<div class="col-sm-6">
					<input type="number" class="form-control" id="inputPostal" 
						<?php if($user->codePostal){
						echo 'placeholder="'.$user->codePostal.'"';}
						else{
							echo 'placeholder="00000"';}?>
					>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCity" class="col-sm-2 col-form-label">Ville :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputCity" 
						<?php if($user->ville){
						echo'placholder="'.$user->ville.'"';}
						else{
							echo 'placeholder="Ville"';}?> 
					>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCountry" class="col-sm-2 col-form-label">Pays :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputCountry" 
						<?php if($user->pays){
							echo'placholder="'.$user->pays.'"';}
							else{
								echo 'placeholder="France"';}?>
					>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="row m-4">
	<div class="col-lg-2 mr-5">
		<h2 style="text-align: center; color: #1EC4E9">Informations de paiement</h2>
	</div>
	<div class="col-sm-2 mt-3 mr-1">
		<div class="input-group mb-3">
			<select class="custom-select" id="typePaiement">
				<option selected>Mode de paiement</option>
				<option value="blockCard"  href="#">Carte bancaire</option>
				<option value="paypal"  href="#">PayPal</option>
				<option value="chqCadeau" href="#">Chèque cadeau</option>
			</select>
		</div>
	</div>
	<div class="col-sm formulaire">
		<div class="blockCard col-sm" style="visibility:<?php echo $popUpCB ?> ; position: absolute;"> <!-- Bloc pour les CB-->
			<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">Carte bancaire</h3>
			<form>
				<div class="form-group row mt-3">
					<label for="inputCard" class="col-sm-2 col-form-label mt-3">Numéro de carte :</label>
					<div class="col-sm-4">
						<input type="text" class="form-control mt-3" id="inputCard" placeholder="XXXX-XXXX-XXXX-XXXX">
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="dateCard" class="col-sm-4 col-form-label mt-3">Date d'expiration :</label>
							<input class="form-control col-6" type="month" value="2019-05" id="example-month-input" style="display: inline-block;">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="nameCard" class="col-sm-2 col-form-label">Nom du titulaire :</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="nameCard">
					</div>
					<div class="input-group col-4 offset-1">
						<select class="custom-select" id="typeCarte">
							<option selected>Type de carte</option>
							<option value="visa"  href="#">Visa</option>
							<option value="american" href="#">AmericanExpress</option>
							<option value="master" href="#">MasterCard</option>
						</select>
					</div>
				</div>
				<div class="form-group row mt-4">
					<label for="securityCode" class="col-sm-2 col-form-label">Code de sécurité:</label>
					<div class="col-2">
						<input type="text" class="form-control" name="securityCode"placeholder="***">
					</div>
					<div class="col-5 ml-auto">
						<button type="button" class="btn btn-success" style=" width : 8em;" id="validerCB">Valider</button> <!--placeholder SQL-->
					</div>
				</div>
			</form>
		</div>
		<div id="paypal" style="visibility:<?php echo $popUpPaypal; ?>; position: absolute; width : 50em; "> <!--Bloc Paypal-->
			<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">PayPal</h3>
			<div class="col-sm mt-3">
				<p style="text-align:center; font-size: 1.3em;">Connexion au compte Paypal</p>
				<form>
					<div class="form-group row">
						<label for="inputEmailPP" class="col-sm-3 col-form-label">Adresse mail :</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="inputEmailPP" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPasswordPP" class="col-sm-3 col-form-label">Mot de passe :</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="inputPasswordPP" placeholder="*******">
						</div>
					</div>
					<button type="button" class="btn btn-success" style="float: right; width : 8em;" id="validerPaypal">Valider</button> <!--placeholder SQL-->
				</form>
			</div>
		</div>
		<div id="chqCadeau" style="visibility: <?php echo $popUpChq; ?> ;">
			<h3 class="pt-3 pb-3"style="font-size : 1.5em; text-align: center;">Chèque cadeau</h3>
			<div class="col-sm mt-3">
				<form>
					<div class="form-group row justify-content-center">
						<label for="numChq" class="col-sm-4 col-form-label mb-2"> Veuillez entrer le code chèque cadeau :</label>
						<div class="col-sm-4">
							<input type="text" id="numChq" class="form-control" placeholder="123456">
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-2">
							<button type="button" class="btn btn-success" id="validerChq">Valider</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php"?>