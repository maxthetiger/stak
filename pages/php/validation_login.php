<?php



	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "signIn"){

		//déclaration des variables du formulaire
		$login 		= "";
		$password	= "";
		$errors_l = array();

		
		//on écrase les valeurs définies ci-dessus, tout en se protegeant
		//pas de strip tags sur la password par contre (si la personne veut mettre des balises dans son pw, c'est son affaire, et on le hache anyway)
		$login 		= strip_tags($_POST['login_l']);
		$password 		= $_POST['pwd_l'];

		//validation

	//login
		if (empty($login)){
			$errors_l[] = "Veuillez entrer votre identifiant !";
		}

	//password
		if (empty($password)){
			$errors_l[] = "Veuillez entrer un password !";
		}

	//form valide ?
	if (empty($errors_l)){

		login_connexion($login, $password);
	}
}

?>
