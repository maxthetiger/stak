<?php 
	session_start();
		include ("pages/functions.php");

	$page = "HOME";
	if (!empty($_GET['page'])){
		$page = $_GET['page'];
	}

	$path = "pages/".$page.".php";

	//echo $path ."<br />";
	//die();
	if (file_exists($path)){
		include($path);
	}
	else {
		die("404");
	}

?>
		