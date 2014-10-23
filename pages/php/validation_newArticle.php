<?php

		$user 			= $_SESSION['user']; print_r($_SESSION);
	//formulaire soumis ?
	if (!empty($_POST)){

		print_r($_POST);
		//déclaration des variables du formulaire
		$q_idUser 		= $user['id'];
		$qTitle 		= "";
		$qContent		= "";
		$qTags  		= "";

		$errors_r = array();
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$qTitle		= strip_tags($_POST['qTitle']);
		$qContent	= $_POST['qContent'];
		$qTags 		= strip_tags($_POST['qTags']);


		////////////
		//validation
		////////////

	//title
		if (empty($qTitle)){
			$errors_r[] = "Veuillez entrer un titre !";
		}
		//vérifie si username est présent en bdd
/**/	elseif (titleExists($qTitle)){
			$errors_r[] = "ce titre d'article est déjà prit !";
		}


	//content
		if (empty($qContent)){
			$errors_r[] = "Veuillez entrer votre question !";
		}

		elseif (strlen($qContent) < 10){
			$errors_r[] = "Votre question n'est pas assez détaillée !";
		}

	//Tags

		if (empty($qTags)){
			$errors_r[] = "Veuillez entrer un ou plusieurs tags !";
		}


		$exploded = multiExplodeTags(array(",",".","|",":"," ",";",", ",". ","| ",": "," ","; "),$qTags);




	//form valide ?
		if (empty($errors_r)){
			//prépare les données pour l'insertion en base

			$newArticle = insertNewArticle($qTitle, $qContent, $q_idUser, $exploded);

		}
	}
?>
