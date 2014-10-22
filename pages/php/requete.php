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
		$user = $stmt->fetchAll();

		//@guillaume : rediriger vers le formulaire de login

		//possibilité d'éffectuer un fetchAll pour pouvoir initier sa session
		sessionStart($user);
	}



				/**************************************
				**************** RESET ****************
				**************************************/


	function updateNewPassword($email, $token, $password){

		$sql = "UPDATE users 
				SET password = :password,
					dateModified = NOW()
				WHERE email = :email 
				AND token = :token";

			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(":password", hashPassword($password, $user['salt']));
			$stmt->bindValue(":email", $email);
			$stmt->bindValue(":token", $token);

			if ($stmt->execute()){

				updateNewToken($email);

			}
	}


	function updateNewToken($email){

		$sql = "UPDATE users 
						SET token = :token,
							dateModified = NOW()
						WHERE email = :email";

				$stmt = $dbh->prepare($sql);
				$stmt->bindValue(":token", randomString());
				$stmt->bindValue(":email", $email);

				if ($stmt->execute()){

					sessionStart($user);
					
				}

	}


