<?php

	session_destroy();
	unset($_SESSION);
	setcookie("PHPSESSID", "", 0);
	header("Location: index.php");
	die();