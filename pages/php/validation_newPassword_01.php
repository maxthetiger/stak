<?php
	
	// on démarre la session
	session_start();

	// on include les functions
	include("functions.php");

	//déclaration des variables du formulaire
	$email 		= "";
	$errors = array();

	//formulaire soumis ?
	if (!empty($_POST)){

		$email = strip_tags($_POST['email']);

		resetPassword($email);
	}
?>