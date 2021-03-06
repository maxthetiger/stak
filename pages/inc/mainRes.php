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
		$userFound = resetGoodUser($email, $token);
	}
	if (empty($userFound)){
		die("oops");
	}



	//déclaration des variables du formulaire
	$password		= "";
	$password_bis 	= "";
	$email			= $userFound['email'];
	$token			= $userFound['token'];
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

<section id="formulaire_container">
	<div id="reset">
		<form method="POST">
			<header>
				<p>Reinitialiser mon password</p>
			</header>
			<input type="password" name="pwd_1" placeholder="Votre nouveau password">
			<input type="password" name="pwd_2" placeholder="Confirmer votre nouveau password">
			<input type="submit" value="reinitialiser">
		</form>
	</div>
</section>