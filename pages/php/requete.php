<?php	


				/**************************************
				*************** REGISTER **************
				**************************************/


	function insertNewUser($email, $pseudo, $hashedPassword, $salt, $token){

		//sql d'insertion de l'user
		$sql = "INSERT INTO users (email, pseudo, password, salt, token, dateRegistered, dateModified) 
				VALUES (:email, :pseudo, :password, :salt, :token, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->bindValue(":password", $hashedPassword);
		$stmt->bindValue(":salt", $salt);
		$stmt->bindValue(":token", $token);

		$stmt->execute();
		//@guillaume : rediriger vers le formulaire de login

		$_SESSION['user'] = $pseudo;
		header("Location: profil.php");
		die();
	}
