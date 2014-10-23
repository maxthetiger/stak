<?php	



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
		
		global $dbh;

		//recherche l'utilisateur en bdd par son username (ou email)
		$sql = "SELECT * FROM users
				WHERE pseudo = :login OR email = :login
				LIMIT 1";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":login", $login);
		$stmt->execute();

		$user = $stmt->fetch();

		$hashedPassword = hashPassword($password, $user['salt']);
		if ($hashedPassword === $user['pwd']){

			sessionStart($user);
		}

	}


				/**************************************
				************ RESET PASSWORD ***********
				**************************************/


	function resetGoodUser($email, $token){

		global $dbh;

		//vérifier que les données dans l'url sont valides
		$sql = "SELECT * FROM users
				WHERE email = :email AND token = :token";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":token", $token);
		$stmt->execute();
		$userFound = $stmt->fetch();

		return $userFound;
	} 


/*	function passwordValidate($password_bis, $password){

		global $dbh;

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
		return $errors;

	}*/



	function resetPassword($email){

		global $dbh;
		
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

		include("phpMailer/PHPMailerAutoload.php"); //chargera les fichiers nécessaires

        $mail = new PHPMailer();        //Crée un nouveau message (Objet PHPMailer)
        $mail->CharSet = 'UTF-8';       //Encodage en utf8

        //INFOS DE CONNEXION
        $mail->isSMTP();                                    //On utilise SMTP
        $mail->Username = "machinchoseformation@gmail.com"; //nom d'utilisateur
        $mail->Password = "38Utc_Sd5KdI4sz0Gr2Y4g";         //mot de passe
        $mail->Host = 'smtp.mandrillapp.com';               //smtp.gmail.com pour gmail
        $mail->Port = 587;                                  //Le numéro de port
        $mail->SMTPAuth = true;                             //On utilise l'authentification SMTP ?
        //$mail->SMTPSecure = 'tls';                        //décommenter pour gmail

        //CONFIGURATION DES PERSONNES
        $mail->setFrom('account@stackode.com', 'Stackode !');                   //qui envoie ce message ? (email, noms)
        $mail->addReplyTo('account@stackode.com', 'Stackode !');        //à qui répondre si on clique sur "reply" (email, noms)
        $mail->addAddress($user['email'], $user['pseudo']);   //destinataire
        
        //CONFIGURATION DU MESSAGE
        $mail->isHTML(true);                                // Contenu du message au format HTML
        $mail->Subject = 'Réinitialisation de password sur Stackode !';         
        

        //le message
			// URGENT
			// Trouver le lien de la page
           $resetUrl = "localhost/CA/10-Octobre/Semaine2/5-Projetstak/stak/index.php?page=reset&email="
            //$resetUrl = "http://localhost/stak/index.php/pages/reset.php?email="
             . urlencode($email) . '&token=' . urlencode($token);

            //le sujet
            $mail->Body = 'Bonjour,<br /> Veuillez clicker sur le lien ci-dessous pour réinitialiser votre password:<br /><a href="'.$resetUrl.'">'.$resetUrl.'</a>';
            
        //envoie le message
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message envoyé!";
        }
	}
}




				/**************************************
				************* QUESTION NEW ************
				**************************************/

	//retourne un booléen, en fonction de si le nom d'utilisateur
	//est présent en bdd
	function titleExists($qTitle){

		global $dbh;

		$sql = "SELECT COUNT(*) FROM article 
				WHERE title = :title";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":title", $qTitle);
		$stmt->execute();

		$titleFound = $stmt->fetchColumn(); //pseudoFound vaut 1 ou 0
		return $titleFound;
	}



		
	function multiExplodeTags ($delimiters,$string) {
	    
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return  $launch;
	}




?>