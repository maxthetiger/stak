<?php

	session_start();

	include("functions.php");

	//déclaration des variables du formulaire
	$login 		= "";
	$password	= "";

	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$login 		= strip_tags($_POST['login']);
		$password 		= $_POST['pwd'];


		//validation

	//login
		if (empty($login)){
			$errors[] = "Veuillez entrer votre identifiant !";
		}

	//password
		if (empty($password)){
			$errors[] = "Veuillez entrer un password !";
		}

	//form valide ?
	if (empty($errors)){

		$login = $login;
		$password = $password

		login_connexion($login, $password);
	}
}

?>
