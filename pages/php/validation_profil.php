<?php	
		

		$pseudo			= "";
		$location		= "";
		$metier			= "";
		$avatar			= "";
		$webSite		= "";
		$github			= "";
		$details		= "";
		$email			= "";
	

		$user 				= $_SESSION["user"];
		$e_idUser 			= $user['id'];

		$old_pseudo			= $user['pseudo'];
		$old_location		= $user['location'];
		$old_metier			= $user['metier'];
		$old_avatar			= $user['avatar'];
		$old_webSite		= $user['webSite'];
		$old_github			= $user['github'];
		$old_details		= $user['details'];
		$old_email			= $user['email'];

	//formulaire soumis ?
	if (!empty($_POST)){
		//déclaration des variables du formulaire
		//print_r($_POST);print_r($_FILES);
		$errors_r = array();
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)

		$pseudo			= strip_tags($_POST['pseudo']);
		$location		= strip_tags($_POST['location']);
		$metier			= strip_tags($_POST['metier']);
		$avatar_temp	= $_FILES['avatar'];
		$avatar 		= $avatar_temp['name'];

		$webSite		= strip_tags($_POST['webSite']);
		$github			= strip_tags($_POST['github']);
		$details		= strip_tags($_POST['details']);
		$email			= strip_tags($_POST["email"]);



		////////////
		//validation
		////////////


		//pseudo
		if (empty($pseudo)){
			$pseudo = $old_pseudo;
		}
		//vérifie si username est présent en bdd
/**/	elseif ((pseudoExists($pseudo)) && ($pseudo != $old_pseudo)){
			$errors_r[] = "Ce pseudo existe déjà !";
		} 

		//Location
		if (empty($location)){
			$location = $old_location;
		} /*else {
			echo "On Earth";
		  }*/

		//Metier
		if (empty($metier)){
			$metier = $old_metier;
		} /*else {echo "Codeur Agréé";
		  }*/

		//Avatar
		if (empty($avatar)){
			$avatar = $old_avatar;
		} 
		/*else {
			$user['avatar'] = '../img/avatar_200.png';
		  }*/

		//WebSite
		if (empty($webSite)){
			$webSite = $old_webSite;
		} /*else {
			echo "www.google.com";
		  }*/

		//Github
		if (empty($github)){
			$github = $old_github;
		} /*else {
			echo "https://github.com/github";
		  }*/

		//Details
		if (empty($details)) {
			$details = $old_details;
		} /*else {
			echo "Welcome Everybody ! Don't search, THE ANSWER IS 42";
		  }*/


		//Email
		if (empty($email)){
			$errors_r[] = "Veuillez entrer votre email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors_r[] = "Votre email est invalide !";
		}
/**/	elseif ((emailExists($email)) && ($email != $old_email)){
			$errors_r[] = "Cet email est déjà prit !";
		}



		//form valide ?
		if (empty($errors_r)){ 
			//prépare les données pour l'insertion en base
		
			$newEdit = completeUserProfil($e_idUser, $pseudo, $location, $metier, $avatar, $webSite, $github, $details, $email);
		}
	}
?>