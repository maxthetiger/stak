<?php	

	function completeUserProfil($e_idUser, $pseudo, $location, $metier, $avatar, $webSite, $github, $details, $email) {



		global $dbh;
		
		$newAvatar = $pseudo .'.jpg';
		$sql = "UPDATE 	users
				SET 	pseudo			= :pseudo,
						location		= :location,
						metier			= :metier,
						avatar			= :avatar,
						webSite			= :webSite,
						github			= :github,
						details			= :details,
						email			= :email,
						dateModified	= NOW()
				WHERE 	id = $e_idUser";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->bindValue(":location", $location);
		$stmt->bindValue(":metier", $metier);
		$stmt->bindValue(":avatar", $newAvatar);
		$stmt->bindValue(":webSite", $webSite);
		$stmt->bindValue(":github", $github);
		$stmt->bindValue(":details", $details);
		$stmt->bindValue(":email", $email);

		$stmt->execute();

	}
				/**************************************
				*************** REGISTER **************
				**************************************/


	function insertNewUser($email, $pseudo, $hashedPassword, $salt, $token){


		$avatar = "avatar_200.png";
		global $dbh;
		//sql d'insertion de l'user
		$sql = "INSERT INTO users (email, pseudo, avatar, pwd, salt, token, dateCreated, dateModified) 
				VALUES (:email, :pseudo, :avatar, :password, :salt, :token, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->bindValue(":avatar", $avatar);
		$stmt->bindValue(":password", $hashedPassword);
		$stmt->bindValue(":salt", $salt);
		$stmt->bindValue(":token", $token);

		$stmt->execute();

		findUser($pseudo);
		//@guillaume : rediriger vers le formulaire de login

		//possibilité d'éffectuer un fetchAll pour pouvoir initier sa session
	}

	function findUser($pseudo) {
		global $dbh;
		//sql d'insertion de l'user
		$sql = "SELECT * FROM users 
				WHERE pseudo = :pseudo";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->execute();
		$user = $stmt->fetch();
		

		sessionStart($user);
	}

				/**************************************
				**************** RESET ****************
				**************************************/


	function updateNewPassword($email, $token, $password){

		global $dbh;
		$sql = "UPDATE users 
				SET pwd = :password,
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

		global $dbh;

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






				/**************************************
				************ NEW QUESTION  ************
				**************************************/



	function insertNewArticle($qTitle, $qContent, $q_idUser, $exploded){

		global $dbh;

		$exploded = $exploded;
		$qTitle = $qTitle;

	//sql d'insertion de l'article
		$sql = "INSERT INTO article (title, content, id_users, dateCreated, dateModified) 
				VALUES (:title, :content, :id_users, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":title", $qTitle);
		$stmt->bindValue(":content", $qContent);
		$stmt->bindValue(":id_users", $q_idUser);

		$stmt->execute();

		$nb = "score+5";
		$score = updatescore($nb);

		$articleID = findArticleID($qTitle, $exploded);
		insertArticleTags($articleID, $exploded);

	}



	function findArticleID($qTitle, $exploded) {

		global $dbh;


		$exploded = $exploded;
		$qTitle = $qTitle;

	//sql recherche l'article
		$sql = "SELECT id FROM article 
				WHERE title = :qTitle";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":qTitle", $qTitle);
		$stmt->execute();
		$articleID = $stmt->fetchColumn();

		
		return $articleID;
	}



	function insertArticleTags($articleID, $exploded) {

		global $dbh;

	//sql d'insertion des tags
		$sql = "INSERT INTO tags (name, id_article) 
					VALUES (:name, :id_article)";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_article", $articleID);

		foreach ($exploded as $name) {
			
			$stmt->bindValue(":name", $name);
			

			$stmt->execute();
		}
		sessionStart($user);
	}



	function insertNewArticleComment($userID, $type, $articleID, $articleComment){

		global $dbh;

	//sql d'insertion des commentaires d'articles
		$sql = "INSERT INTO comment (comment, id_article, id_users, typeComRep, dateCreated, dateModified) 
				VALUES (:comment, :id_article, :id_users, :typeComRep, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_article", $articleID);
		$stmt->bindValue(":id_users", $userID);
		$stmt->bindValue(":typeComRep", $type);
		$stmt->bindValue(":comment", $articleComment);

		$stmt->execute();

		$nb = "score+1";
		$score = updatescore($nb);
		
		afficheArticleComment($type, $articleComment, $articleID);
	
	}


	function insertNewArticleReponse($userID, $idThis, $reponse){
		global $dbh;

	//sql d'insertion des commentaires d'articles
		$sql = "INSERT INTO reponse (reponse, id_article, id_users, dateCreated, dateModified) 
				VALUES (:reponse, :id_article, :id_users, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_article", $idThis);
		$stmt->bindValue(":id_users", $userID);
		$stmt->bindValue(":reponse", $reponse);

		$stmt->execute();
		
		$nb = "score+10";
		$score = updatescore($nb);

		afficheArticleReponse($idThis);
	}



	function insertNewReponseComment($userID, $type, $reponseID, $comment){

		global $dbh;

	//sql d'insertion des commentaires d'articles
		$sql = "INSERT INTO comment (comment, id_reponse, id_users, typeComRep, dateCreated, dateModified) 
				VALUES (:comment, :id_reponse, :id_users, :typeComRep, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_reponse", $reponseID);
		$stmt->bindValue(":id_users", $userID);
		$stmt->bindValue(":typeComRep", $type);
		$stmt->bindValue(":comment", $comment);

		$stmt->execute();
		$nb = "score+1";
		$score = updatescore($nb);
		
		//afficheReponseComment($type, $comment, $reponseID);
	
	}


	function updatescore($nb){
		$id = $_SESSION['user']['id'];
		/*$score = $_SESSION['user']['score'] + $nb;
		echo $score;*/

		global $dbh;

		$sql = "UPDATE users 
				SET score = $nb,
					dateModified = NOW()
				WHERE id = :id";

		$stmt = $dbh->prepare($sql);
	/*	$stmt->bindValue(":score", $score);*/
		$stmt->bindValue(":id", $id);

		$stmt->execute();
		
	}

	function updateArticleNote($nba, $articleID){
		$id = $_SESSION['user']['id'];
		global $dbh;
		

		$sql = "UPDATE article 
				SET note = $nba,
					dateModified = NOW()
				WHERE id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id", $articleID);

		$stmt->execute();
		
	}