<?php	


				/**************************************
				*************** REGISTER **************
				**************************************/


	//retourne un booléen, en fonction de si le nom d'utilisateur
	//est présent en bdd
	function pseudoExists($pseudo_reg){

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
	function emailExists($email_reg){

		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE email = :email";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email_reg);
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