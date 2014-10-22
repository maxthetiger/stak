<?php

	// on demarre la session
	session_start();

	// on include nos functions
	include("functions.php");

	// on recupere le get généré par le lien envoyé dans l'email
	$email = "";
	if (!empty($_GET['email'])){
		$email = $_GET['email'];
	}		
	$token = "";
	if (!empty($_GET['token'])){
		$token = $_GET['token'];
	}

	if ($token && $email){
		resetGoodUser($email, $token);
	}


	if (empty($user)){
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
		passwordValidate($password_bis, $password);



		if (empty($errors)){

			updateNewPassword($email, $token, $password);
			
		}
	}
?>