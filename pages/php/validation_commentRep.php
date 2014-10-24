<?php


		$userID 			= "";
		$reponseID  		= "";
		$type				= "";
		$comment			= "";
	//formulaire soumis ?


	if (!empty($_POST) && $_POST['form'] == "reponseComment"){


		$errors_cr = array();

		if (!userIsLogged()){
			header("Location: index.php?page=register");
			die();
		}

		$user = $_SESSION['user'];
		$userID = $user['id'];


		$reponseID  		= ($_POST['reponseID']);
		$type				= "1";
		$comment		= strip_tags($_POST['commentReponse']);

	
	

		////////////
		//validation
		////////////

	//username
		if (empty($comment)){
			$errors_cr[] = "Veuillez entrer un commentaire !";
		}

		elseif (strlen($comment) < 3) {
			$errors_cr[] = "Veuillez entrer un commentaire plus long !";
		}
		
	//form valide ?
		if (empty($errors_cr)){


			$newReponseComment = insertNewReponseComment($userID, $type, $reponseID, $comment);

		}
	}
?>
