<?php include "header.php"?>

<div class="row">
	<div class="col bg-info" id="banniere"> <!--placeholder SQL-->
		<div class="row">
			<div class="col-2 text-white" id="NomPrenom" style="padding : 1.5em 0 1em 3em;">
				Nom Prénom <!--placeholder SQL-->
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1" id="iconUser" style="padding : 0 0 3em 5em"> <!--placeholder SQL-->
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
					<input type="text" class="form-control" id="inputAddress" placeholder="Adresse">
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
					<input type="number" class="form-control" id="inputPostal" placeholder="00000">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCity" class="col-sm-2 col-form-label">Ville :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputCity" placeholder="Ville">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCountry" class="col-sm-2 col-form-label">Pays :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputCountry" placeholder="France">
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
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="typePaiement" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Modes de paiement
			</button>
			<div class="dropdown-menu" aria-labelledby="typePaiement">
				<a class="dropdown-item" id="visa" href="#">Visa</a>
				<a class="dropdown-item" id="master" href="#">MasterCard</a>
				<a class="dropdown-item" id="american" href="#">AmericanExpress</a>
				<a class="dropdown-item" id="paypal" href="#">PayPal</a>
				<a class="dropdown-item" id="chqCadeau" href="#">Chèque cadeau</a>
			</div>
		</div>
	</div>
	<div class="col-sm">
		<div id="blockCard" style="visibility: ; position: absolute;"> <!-- Bloc pour les CB-->
			<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">Carte bancaire (Visa, MasterCard, AmericanExpress)</h3>
			<form>
				<div class="form-group row">
					<label for="inputCard" class="col-sm-2 col-form-label pt-3">Numéro de carte :</label>
					<div class="col-sm-4">
						<input type="text" class="form-control mt-3" id="inputCard" placeholder="XXXX-XXXX-XXXX-XXXX">
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="dateCard" class="col-sm-5 col-form-label">Date d'expiration</label>
							<select>
								<option value="01">January</option>
								<option value="02">February </option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							<select>
								<option value="19"> 2019</option>
								<option value="20"> 2020</option>
								<option value="21"> 2021</option>
								<option value="22"> 2022</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="nameCard" class="col-sm-2 col-form-label">Nom du titulaire :</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="nameCard">
					</div>
				</div>
				<div class="form-group row">
					<label for="securityCode" class="col-sm-2 col-form-label">Code de sécurité:</label>
					<div class="col-2">
						<input type="text" class="form-control" name="securityCode"placeholder="***">
					</div>
				</div>
			</form>
		</div>
		<div id="paypalAccount" style="visibility: hidden; position: absolute;"> <!--Bloc Paypal-->
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
				</form>
			</div>
		</div>
		<div id="chqCadeau" style="visibility:hidden;">
			<h3 class="pt-3"style="font-size : 1.5em; text-align: center;">Chèque cadeau</h3>
			<div class="col-sm mt-3">
				<form>
					<div class="form-group row">
						<label for="numChq" class="col-sm-5 col-form-label mb-2"> Veuillez entrer le code chèque cadeau :</label>
						<div class="col-sm-6">
							<input type="text" id="numChq" class="form-control" placeholder="123456">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>

<?php include "footer.php"?>