<?php

require_once 'phpClass/autoloader.php';

if(!empty($_POST)){
	print_r($_POST);

	$erreurs = array();
	$db = Site::getDatabase();
	

	// test adresse
	if($_POST['inputAdresse'] != null && !Validation::isAlphanumeric($_POST['inputAdresse']) ) {
		array_push($erreurs, "L'adresse n'est pas valide ou définie");
		Site::redirection('compte.php');
		exit();
	}   

 // test code postal
	if($_POST['inputPostal'] != null && !Validation::isAlphanumeric($_POST['inputPostal']) ) {
		array_push($erreurs, "Le code postal n'est pas valide ou définie");
		Site::redirection('compte.php');
		exit();
	}      

 // test ville
	if($_POST['inputCity'] != null && !Validation::isAlphanumeric($_POST['inputCity']) ) {
		array_push($erreurs, "La ville n'est pas valide ou définie");
		Site::redirection('compte.php');
		exit();
	}      

 // test pays
	if($_POST['inputCountry'] != null && !Validation::isAlphanumeric($_POST['inputCountry']) ) {
		array_push($erreurs, "Le pays n'est pas valide ou définie");
		Site::redirection('compte.php');
		exit();
	}

	if($_POST == "blockCard"){
	//Vérification numéro de carte
		if(!isset($_POST['inputCard']) || empty($_POST['inputCard'])) {
			array_push($erreurs, "Le numéro de carte n'a pas été saisi");
		} 
	//Vérification nom du titulaire de la carte
		if(!isset($_POST['nameCard']) || empty($_POST['nameCard'])) {
			array_push($erreurs, "Aucun nom n'a été saisi");
		}else {
			if( !Validation::isAlphanumeric($_POST['nameCard']) ) {
				array_push($erreurs, "ton nom n'est pas valide");
			}
		}

	//Vérification type de carte
		if(!isset($_POST['typeCarte']) || empty($_POST['typeCarte']) || $_POST['typeCarte'] == null) {
			array_push($erreurs, "Le type de carte n'a pas été choisi");
		} 

	//Vérification code de sécurité
		if(!isset($_POST['securityCode']) || empty($_POST['securityCode']) || $_POST['securityCode'] == '***') {
			array_push($erreurs, "Le code de sécurité n'a pas été saisi");
		} 
	}
	if($_POST == "paypal"){
	//Vérification mail Paypal
		if(!isset($_POST['inputEmailPP']) || !Validation::isMail($_POST['inputEmailPP']) ) {
			array_push($erreurs, "L'email saisi n'est pas valide");
		}

    //Vérification mdp Paypal
		if( !isset($_POST['inputPasswordPP']) || empty($_POST['inputPasswordPP']) ) {
			array_push($erreurs, "Aucun mot de passe n'a été saisi");
		}
	}

	if($_POST == "chqCadeau"){
    //Vérification code cadeau
		if(!isset($_POST['numChq']) || empty($_POST['numChq']) || $_POST['numChq'] == '123456') {
			array_push($erreurs, "Le code de sécurité n'a pas été saisi");
		}
	}

	if(empty($erreurs)){
		if($userPaiement == null){
			Site::getDatabase()->requete('INSERT INTO cartesbancaires (idUser, numero, codeSecurite, dateExpiration, type) VALUES ("'.$user->idUser.'", "'.$_POST['inputCard'].'","'.$_POST['securityCode'].'","'.$_POST['dateCard'].'","'.$_POST['typeCarte'].'"');
		}
		else{
			Site::getDatabase()->requete('UPDATE cartesbancaires SET numero = ?, codeSecurite = ?, dateExpiration = ?, type = ? WHERE idUser = ?',[$_POST['inputCard'],$_POST['securityCode'],$_POST['dateCard'],$_POST['typeCarte'], $user->idUser]);
		}
		$session->addMessage('success', "Le paiement a été effectué. Votre commande sera bientôt expédiée.");
		Site::redirection('index.php');
		exit();
		
	}
	else {
		Session::getSession()->addMessages('danger', $erreurs);
		Site::redirection('commmande.php');
	}


}
else{
	Session::getSession()->addMessage('info', "erreur d'url tu n'es pas en train de passer commande");
	Site::redirection('commande.php');
}

?> 