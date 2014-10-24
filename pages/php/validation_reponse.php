<?php


		$userID 			= "";
		$idThis  		= "";
		$type				= "";
		$articleComment		= "";
	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "reponseArticle"){
		

		$errors_ra = array();

		if (!userIsLogged()){
			header("Location: index.php?page=register");
			die();
		}

		$user 			= $_SESSION['user'];
		$userID 		= $user['id'];
		
		$idThis  	= $_POST['articleID'];
		$reponse		= $_POST['aContent'];
	
		////////////
		//validation
		////////////

	//reponse
		if (empty($reponse)){
			$errors_ra[] = "Veuillez entrer une réponse !";
		}

		elseif (strlen($reponse) < 3) {
			$errors_ra[] = "Veuillez entrer une réponse plus longue !";
		}
		
	//form valide ?
		if (empty($errors_ra)){


			$newArticleComment = insertNewArticleReponse($userID, $idThis, $reponse);

		}
	}
?>
