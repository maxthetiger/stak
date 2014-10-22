<?php	



				/**************************************
				************ USER CONNECTED ***********
				**************************************/


	function sessionStart($user){

		//log the user automatically
		$_SESSION['user'] = $user;
		header("Location: index.php");
		die();
	}


	// on test la session pour savoir si elle est vide
	function userIsLogged(){
		if (!empty($_SESSION['user'])){
			return true;
		}
		return false;
	}


				/**************************************
				*************** REGISTER **************
				**************************************/


	//retourne un booléen, en fonction de si le nom d'utilisateur
	//est présent en bdd
	function pseudoExists($pseudo){

		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE pseudo = :pseudo";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->execute();

		$pseudoFound = $stmt->fetchColumn(); //pseudoFound vaut 1 ou 0
		return $pseudoFound;
	}


	//retourne un booléen, en fonction de si l'email
	//est présent en bdd
	function emailExists($email){

		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE email = :email";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();

		$emailFound = $stmt->fetchColumn(); //emailFound vaut 1 ou 0
		return $emailFound;
	}


	//retourne une chaîne aléatoire, d'une longueur $length
	function randomString($length = 50){
		$chars = "ABCDEFGHIJKLMNOPQRSTRUVWYXZabcdefghijklmnopqrstruvwyxz0123456789";
		$string = "";
		for($i=0;$i<$length;$i++){
			$num = mt_rand(0, strlen($chars)-1);
			$string .= $chars[$num];
		}
		return $string;
	}

	//hache le mot de passe, d'une manière lente
	//utilise un salt unique par utilisateur, et un pepper fixe
	function hashPassword($password, $salt){
		$pepper = "zDO3Byl7rsYAgz6fGAjf4*Ej23dvlAvvmOzFXG3E2m4FTXb4l5o";
		$hashedPassword = hash("sha512", $password);
		for($i=0;$i<5000;$i++){
			$hashedPassword = hash("sha512", $pepper . $hashedPassword . $salt);
		}
		return $hashedPassword;
	}



				/**************************************
				**************** LOGIN ****************
				**************************************/


	//On valide la tentative de connexion
	function login_connexion($login, $password){
		
		//recherche l'utilisateur en bdd par son username (ou email)
		$sql = "SELECT * FROM users
				WHERE pseudo = :login OR email = :login
				LIMIT 1";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":login", $login);
		$stmt->execute();

		$user = $stmt->fetch();

		$hashedPassword = hashPassword($password, $user['salt']);
		if ($hashedPassword === $user['password']){

			sessionStart($user);
		}



				/**************************************
				************ RESET PASSWORD ***********
				**************************************/


	function resetGoodUser($email, $token){


		//vérifier que les données dans l'url sont valides
		$sql = "SELECT * FROM users
				WHERE email = :email AND token = :token";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":token", $token);
		$stmt->execute();
		$user = $stmt->fetch();

	}


	function passwordValidate($password_bis, $password){

		//password
		if (empty($password)){
			$errors[] = "Veuillez entrer un password !";
		}
		elseif (empty($password_bis)){
			$errors[] = "Veuillez confirmer votre password !";
		}
		elseif ($password_bis != $password){
			$errors[] = "Vos passwords ne sont pas identiques !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Votre password doit comporter au minmum 7 caractères !";
		}


	}



	function resetPassword($email){

		//vérifier que l'email existe bel et bien
		$sql = "SELECT email, pseudo, token FROM users
				WHERE email = :email";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$user = $stmt->fetch();


		if (!empty($user)){

			$email	= $user['email'];
			$token	= $user['token'];
			$pseudo	= $user['pseudo'];

			//envoyer un message
			sendResetPassword($email, $pseudo, $token);

		}
	}





