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

	</head>
	<!-- Fin En-tête -->

<?php 
if (!empty($page) && ($page == "register" || $page == "reset") ) {
		echo '<body id="body_blue">';
	} else { echo '<body id="body">';} 
?>