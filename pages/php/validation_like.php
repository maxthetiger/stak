<?php
		$articleID	= "";
		$like  				= "";
	//formulaire soumis ?
	if (!empty($_POST) && $_POST['form'] == "liking"){
		$articleID	= ($_POST['articleID']);
		
		$like		= ($_POST['Like']);

		if ($like == "like"){
			$nb = "score+2";
			$nba = "note+1";
			$toto = updatescore($nb);
			$tata =  updateArticleNote($nba, $articleID);
		/*	die();*/

		}

		elseif ($like == "unlike") {
			$nb = "score-2";
			$tata = updatescore($nb);
		}
	}
?>
