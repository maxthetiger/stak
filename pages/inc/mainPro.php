<section id="mainPro">
	<nav id="navPro">
		<div class="edit <?php if ($_GET['onglet'] == "edit") {echo "active";} ?> ">
			<a href="?page=profil&onglet=edit">edit</a>
		</div>
		<div class="view <?php if ($_GET['onglet'] == "view") {echo "active";} ?>">
			<a href="?page=profil&onglet=view">view</a>
		</div>
		<div class="dash <?php if ($_GET['onglet'] == "dash") {echo "active";} ?>">
			<a href="?page=profil&onglet=dash">dashboard</a>
		</div>
	</nav>
</section>