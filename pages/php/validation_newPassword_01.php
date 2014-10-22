<?php
	

	
	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "remember"){

	//déclaration des variables du formulaire
	$email 		= "";
	$errors_f = array();

		$email = strip_tags($_POST['email_f']);

		resetPassword($email);
	}
?>