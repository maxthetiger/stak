<?php



	// on recupere le get généré par le lien envoyé dans l'email
	$email = "";
	if (!empty($_GET['email'])){
		$email = urldecode($_GET['email']);
	}		
	$token = "";
	if (!empty($_GET['token'])){
		$token = $_GET['token'];
	}

	if ($token && $email){
		resetGoodUser($email, $token);
	}


	if (empty($userFound)){
		die("oops");
	}



	//déclaration des variables du formulaire
	$password		= "";
	$password_bis 	= "";

	$errors_new = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		$password			= $_POST["pwd_1"];
		$email 				= $_POST["email"];
		$token 				= $_POST["token"];
		$password_bis 		= $_POST['pwd_2'];


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

		if (empty($errors)){

			updateNewPassword($email, $token, $password);
			
		}
	}
?>