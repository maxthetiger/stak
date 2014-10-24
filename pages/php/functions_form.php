<?php	



	function profilComplete($e_idUser, $pseudo, $location, $metier, $avatar, $webSite, $github, $details, $email) {

		global $dbh;

		$sql = "SELECT * FROM users
				WHERE 	id 			= $e_idUser
						pseudo 		= :pseudo,
						location	= :location,
						metier		= :metier,
						avatar		= :avatar,
						webSite		= :webSite,
						github		= :github,
						details		= :details,
						email		= :email";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->bindValue(":location", $location);
		$stmt->bindValue(":metier", $metier);
		$stmt->bindValue(":avatar", $avatar);
		$stmt->bindValue(":webSite", $webSite);
		$stmt->bindValue(":github", $github);
		$stmt->bindValue(":details", $details);
		$stmt->bindValue(":email", $email);
		$stmt->execute();

		$profilAccess = $stmt->fetchAll();
		return $profilAccess;
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




				/**************************************
				************* ALL ARTICLES ************
				**************************************/

	function catchAllArticles(){

		global $dbh;

		$sql = "SELECT 
					article.id AS articleID,
					article.title,
					article.content,
					article.view,
					article.dateCreated,
					article.dateModified,
					article.id_users,
					users.id AS usersID,
					users.pseudo,
					users.location,
					users.avatar,
					users.score,
					users.status
				FROM article
				JOIN users 	ON article.id_users = users.id
				ORDER BY article.dateCreated DESC";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$allArticles = $stmt->fetchAll();
		return $allArticles;
	}


	
	function getThisTags($idThis){

		global $dbh;

		$sql = "SELECT name 
				FROM tags
				WHERE id_article = $idThis";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$allTagsArticles = $stmt->fetchAll();
		return $allTagsArticles;
	}



	function catchThisArticles($idThis){
		global $dbh;

		$sql = "SELECT 	article.id AS articleID,
						article.title,
						article.content,
						article.view,
						article.dateCreated,
						article.dateModified,
						article.id_users,
						users.id AS usersID,
						users.pseudo,
						users.location,
						users.avatar,
						users.score,
						users.status
				FROM article
				JOIN users	ON article.id_users = users.id
				WHERE article.id = $idThis";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$ThisArticle = $stmt->fetch();

		return $ThisArticle;
	}


		function afficheArticleComment($idThis){
		global $dbh;

		$sql = "SELECT 	comment.id AS commentID,
						comment.id_article,
						comment.comment,
						comment.typeComRep,
						comment.id_users,
						comment.dateCreated,
						users.id AS usersID,
						users.pseudo
				FROM comment
				JOIN users	ON comment.id_users = users.id
				WHERE 	comment.typeComRep = 0
				AND 	comment.id_article = $idThis
				ORDER BY comment.dateCreated DESC";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$ThisCom = $stmt->fetchAll();

		return $ThisCom;
	}


	function afficheArticleReponse($idThis){

	global $dbh;

		$sql = "SELECT 	reponse.id AS reponseID,
						reponse.id_article,
						reponse.reponse,
						reponse.best,
						reponse.note,
						reponse.id_users,
						reponse.dateCreated,
						users.id AS usersID,
						users.pseudo,
						users.location,
						users.avatar,
						users.score,
						users.status
				FROM reponse
				JOIN users	ON reponse.id_users = users.id
				WHERE 	reponse.id_article = $idThis
				ORDER BY reponse.dateCreated DESC";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$ThisRem = $stmt->fetchAll();

		return $ThisRem;
	}


	function afficheReponseComment($type, $comment, $reponseID){
		global $dbh;

		
		$sql = "SELECT 	comment.id AS commentID,
						comment.id_reponse,
						comment.comment,
						comment.typeComRep,
						comment.id_users,
						comment.dateCreated,
						users.id AS usersID,
						users.pseudo
				FROM comment
				JOIN users	ON comment.id_users = users.id
				WHERE 	comment.typeComRep = 1
				AND 	comment.id_reponse = $reponseID
				ORDER BY comment.dateCreated DESC";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$ThisComRep = $stmt->fetchAll();

		return $ThisComRep;


	}



	function selectMyQuestions(){
		global $dbh;
		$idUser = $_SESSION['user']['id'];

		$sql = "SELECT 	article.id AS articleID,
						article.title,
						article.dateCreated,
						article.id_users,
						users.id AS usersID
				FROM article
				JOIN users	ON article.id_users = users.id
				WHERE users.id = $idUser
				ORDER BY article.dateCreated DESC
				LIMIT 5";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$myQuestion = $stmt->fetchAll();

		return $myQuestion;
	}


	function selectMyReponses(){
		global $dbh;

		$idUser = $_SESSION['user']['id'];

		$sql = "SELECT 	reponse.id AS reponseID,
						reponse.reponse,
						reponse.dateCreated,
						reponse.id_article,
						reponse.id_users,
						users.id AS usersID
				FROM reponse
				JOIN users	ON reponse.id_users = users.id
				WHERE users.id = $idUser
				ORDER BY reponse.dateCreated DESC
				LIMIT 5";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$myReponses = $stmt->fetchAll();

		return $myReponses;
	}



	//$str est la chaîne de caractères et $nb le nombre de caractères maximum à afficher.
	function tronque($str, $nb = 50) 
	{
    // Si le nombre de caractères présents dans la chaine est supérieur au nombre 
    // maximum, alors on découpe la chaine au nombre de caractères 
    if (strlen($str) > $nb) 
    {
        $str = substr($str, 0, $nb);
        $position_espace = strrpos($str, " "); //on récupère l'emplacement du dernier espace dans la chaine, pour ne pas découper un mot.
        $texte = substr($str, 0, $position_espace);  //on redécoupe à la fin du dernier mot
        $str = $str."..."; //puis on rajoute des ...
    }
    return $str; //on retourne la variable modifiée
	}




?>