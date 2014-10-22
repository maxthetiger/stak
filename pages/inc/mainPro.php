<section id="mainPro">

<?php
	if (userIsLogged()):
?>
		<nav id="navPro">
			<div class="edit <?php if ($_GET['onglet'] == "edit") {echo "active";} ?> ">
				<a href="?page=profil&onglet=edit">edit</a>
			</div>
			<div class="view <?php if ($_GET['onglet'] == "view") {echo "active";} ?>">
				<a href="?page=profil&onglet=view">view</a>
			</div>
		</nav>

<?php endif; ?>
	
</section>