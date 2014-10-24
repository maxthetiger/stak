<?php


		$userID 			= "";
		$articleID  		= "";
		$type				= "";
		$articleComment		= "";
	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "commentArticle"){
		

		$errors_ca = array();

		if (!userIsLogged()){
			header("Location: index.php?page=register");
			die();
		}

		$user = $_SESSION['user'];
		$userID = $user['id'];
		
		$articleID  		= ($_POST['articleID']);
		$type				= "0";
		$articleComment		= strip_tags($_POST['articleComment']);

	

		////////////
		//validation
		////////////

	//username
		if (empty($articleComment)){
			$errors_ca[] = "Veuillez entrer un commentaire !";
		}

		elseif (strlen($articleComment) < 3) {
			$errors_ca[] = "Veuillez entrer un commentaire plus long !";
		}
		
	//form valide ?
		if (empty($errors_ca)){


			$newArticleComment = insertNewArticleComment($userID, $type, $articleID, $articleComment);

		}
	}
?>
