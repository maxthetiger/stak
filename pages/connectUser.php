<?php

				/**************************************
				************ USER CONNECTED ***********
				**************************************/


	function sessionStart($user){

		global $dbh;

		//log the user automatically
		$_SESSION['user'] = $user;
		header("Location: index.php?page=home");
		die();
	}


	// on test la session pour savoir si elle est vide
	function userIsLogged(){
		
		global $dbh;

		if (!empty($_SESSION['user'])){
			return true;
		}
		return false;
	}