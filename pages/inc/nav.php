
<?php 
if (!empty($page) &&  ($page != "question" )):
		echo '
	<nav id="nav">
		<a href="?page=home" class="active">NewStakode</a>
		<a href="?page=tutos" >Tuto +</a>
		<a href="?page=work" >Carrière</a>
		<a href="#">Actu / Evènements</a>
	</nav>';

endif; 
?>



<!-- 
<?php // if ($_GET['page'] == "home") {echo "active";} ?>
<?php // if ($_GET['page'] == "tutos") {echo "active";} ?>
<?php // if ($_GET['page'] == "work") {echo "active";} ?>
-->