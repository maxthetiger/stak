<?php

	include("functions_form.php");

	//déclaration des variables du formulaire
	$pseudo 		= "";
	$email 			= "";
	$email_bis		= "";
	$password  		= "";
	$password_bis 	= "";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$pseudo  		= strip_tags($_POST['pseudo']);
		$email			= strip_tags($_POST['email_1']);
		$email_bis		= strip_tags($_POST['email_2']);
		$password 		= $_POST['pwd_1'];
		$password_bis 	= $_POST['pwd_2'];

		////////////
		//validation
		////////////

	//username
		if (empty($pseudo)){
			$errors[] = "Veuillez entrer un pseudo !";
		}
		//vérifie si username est présent en bdd
/**/	elseif (pseudoExists($pseudo)){
			$errors[] = "Désolé ce pseudo est déjà prit !";
		}


	//email
		if (empty($email)){
			$errors[] = "Veuillez entrer votre email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Votre email est invalide !";
		}
/**/	elseif (emailExists($email)){
			$errors[] = "Cet email est déjà prit !";
		}


	//email_bis
		if (empty($email_bis)){
			$errors[] = "Veuillez confirmer votre email !";
		}
		elseif ($email_bis != $email_bis ){
			$errors[] = "Vos emails ne sont pas identiques !";
		}


	//password
		passwordValidate($password_bis, $password);


	//form valide ?
		if (empty($errors)){
			//prépare les données pour l'insertion en base

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
