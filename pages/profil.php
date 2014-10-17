<?php 
	include ("inc/atop.php");
	include ("inc/ahead.php");
	include ("inc/nav.php");
	include ("inc/mainPro.php");
	
	if (!empty($_GET['onglet'])){

		if (!empty($_GET['onglet'] == 'edit')){
			include ("inc/profil/edit.php");
		} elseif (!empty($_GET['onglet'] == 'view')){
			include ("inc/profil/view.php");
		}
	}
		else { include ("inc/profil/dashboard.php");
		}

	include ("inc/zfoot.php");
	include ("inc/zbottom.php");
?>