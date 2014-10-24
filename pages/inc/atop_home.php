<!DOCTYPE HTML>

<!-- Début du code -->
<html lang="fr" class="<?php echo $page; ?>">
	<!-- Début En-tête -->
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
			<title>STACKODE | <?php echo $page; ?></title>
			<link rel="stylesheet" href="css/style.css">
			<link rel="stylesheet" href="css/profil_style.css">
			<link rel="stylesheet" href="css/jquery-ui.min.css">

  			<link href="css/buddycloud.css" rel="stylesheet" />
 			<link href="css/paperfold.css" rel="stylesheet" />
 			
  		<!--	<script type="text/javascript" src="js/modernizr.custom.71147.js"></script> -->
  			<script type="text/javascript" src="js/prefixfree.min.js"></script>

	</head>
	<!-- Fin En-tête -->

<?php 
if (!empty($page) && ($page == "register" || $page == "reset" || $page == "question" ) ) {
		echo '<body id="body_blue">';
	} else { echo '<body id="body">';} 
?>