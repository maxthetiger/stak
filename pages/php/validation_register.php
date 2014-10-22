<?php




	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "signUp"){
		//déclaration des variables du formulaire
		$pseudo 		= "";
		$email 			= "";
		$email_bis		= "";
		$password  		= "";
		$password_bis 	= "";
		$errors_r = array();
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$pseudo  		= strip_tags($_POST['pseudo_r']);
		$email			= strip_tags($_POST['email_1_r']);
		$email_bis		= strip_tags($_POST['email_2_r']);
		$password 		= $_POST['pwd_1_r'];
		$password_bis 	= $_POST['pwd_2_r'];

		////////////
		//validation
		////////////

	//username
		if (empty($pseudo)){
			$errors_r[] = "Veuillez entrer un pseudo !";
		}
		//vérifie si username est présent en bdd
/**/	elseif (pseudoExists($pseudo)){
			$errors_r[] = "Désolé ce pseudo est déjà prit !";
		}


	//email
		if (empty($email)){
			$errors_r[] = "Veuillez entrer votre email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors_r[] = "Votre email est invalide !";
		}
/**/	elseif (emailExists($email)){
			$errors_r[] = "Cet email est déjà prit !";
		}


	//email_bis
		if (empty($email_bis)){
			$errors_r[] = "Veuillez confirmer votre email !";
		}
		elseif ($email != $email_bis ){
			$errors_r[] = "Vos emails ne sont pas identiques !";
		}


	//password
		if (empty($password)){
			$errors_r[] = "Veuillez entrer un password !";
		}
		elseif (empty($password_bis)){
			$errors_r[] = "Veuillez confirmer votre password !";
		}
		elseif ($password_bis != $password){
			$errors_r[] = "Vos passwords ne sont pas identiques !";
		}
		elseif (strlen($password) < 7){
			$errors_r[] = "Votre password doit comporter au minmum 7 caractères !";
		}

	//form valide ?
		if (empty($errors_r)){
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
