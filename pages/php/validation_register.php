<?php

	include("functions_form.php");

	//déclaration des variables du formulaire
	$pseudo_reg 		= "";
	$email_reg 			= "";
	$email_reg_bis		= "";
	$password_reg  		= "";
	$password_reg_bis 	= "";

	$errors_reg = array();

	//formulaire soumis ?
	if (!empty($_POST)){
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$pseudo_reg  		= strip_tags($_POST['pseudo']);
		$email_reg			= strip_tags($_POST['email_1']);
		$email_reg_bis		= strip_tags($_POST['email_2']);
		$password_reg 		= $_POST['password'];
		$password_reg_bis 	= $_POST['password_bis'];

		////////////
		//validation
		////////////

	//username
		if (empty($pseudo_reg)){
			$errors_reg[] = "Veuillez entrer un pseudo !";
		}
		//vérifie si username est présent en bdd
/**/	elseif (pseudoExists($pseudo)){
			$errors_reg[] = "Désolé ce pseudo est déjà prit !";
		}


	//email
		if (empty($email_reg)){
			$errors_reg[] = "Veuillez entrer votre email !";
		}
		elseif (!filter_var($email_reg, FILTER_VALIDATE_EMAIL)){
			$errors_reg[] = "Votre email est invalide !";
		}
/**/	elseif (emailExists($email_reg)){
			$errors_reg[] = "Cet email est déjà prit !";
		}


	//email_bis
		if (empty($email_reg_bis)){
			$errors_reg[] = "Veuillez confirmer votre email !";
		}
		elseif ($email_reg_bis != $email_reg_bis ){
			$errors_reg[] = "Vos emails ne sont pas identiques !";
		}


	//password
		if (empty($password_reg)){
			$errors_reg[] = "Veuillez choisir un password !";
		}
		elseif (empty($password_reg_bis)){
			$errors_reg[] = "Veuillez confirmer votre password !";
		}
		elseif ($password_reg_bis != $password_reg){
			$errors_reg[] = "Vos passwords ne sont pas identiques !";
		}
		elseif (strlen($password_reg) < 7){
			$errors_reg[] = "Votre password est trop court !";
		}


	//form valide ?
		if (empty($errors_reg)){
			//prépare les données pour l'insertion en base

			// je renomme ma variable de password
			$password = $password_reg;

			//génère un salt unique pour cet user
/**/		$salt = randomString();

			//fonction déclarée dans functions.php
/**/		$hashedPassword = hashPassword($password, $salt);

			//utilisée pour l'oubli du mdp, le remember me...
/**/		$token = randomString();


			$newUser = insertNewUser($email, $pseudo, $hashedPassword, $salt, $token);

		}
	}
?>
