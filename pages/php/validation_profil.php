<?php	


				/**************************************
				*************** PROFIL **************
				**************************************/


	function completeUserProfil($pseudo, $location, $metier, $avatar, $webSite, $github, $details, $email){

		global $dbh;
		//sql d'insertion de l'user
		$sql = "INSERT INTO users (pseudo, location, metier, avatar, webSite, github, details, email, dateCreated, dateModified) 
				VALUES (:pseudo, :location, :metier, :avatar, :webSite, :github, :details, :email, NOW(), NOW())";

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

		$user = $stmt->fetch();
	}
?>