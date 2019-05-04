<?php 
	
	//Vérification numéro de carte
	if(!isset($_POST['inputCard']) || empty($_POST['inputCard']) || $_POST['inputCard'] == 'XXXX-XXXX-XXXX-XXXX') {
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

	//Vérification mail Paypal
	if(!Validation::isMail($_POST['inputEmailPP']) ) {
    array_push($erreurs, "L'email saisi n'est pas valide");

    //Vérification mdp Paypal
    if( !isset($_POST['inputPasswordPP']) || empty($_POST['inputPasswordPP']) ) {
    	array_push($erreurs, "Aucun mot de passe n'a été saisi");
    }

    //Vérification code cadeau
    if(!isset($_POST['numChq']) || empty($_POST['numChq']) || $_POST['numChq'] == '123456') {
		array_push($erreurs, "Le code de sécurité n'a pas été saisi");
	}
  } 
?> 