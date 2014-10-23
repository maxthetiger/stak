<?php 
	include ("pages/php/validation_newArticle.php");
?>


<section id="formulaire_container">
	<div id="question">
		<form method="POST">
			<header>
				<p>Nouvelle question</p>
			</header>

			<input type="hidden" name="form" value="questionPost">
			<input type="text" name="qTitle" placeholder="Votre titre">
			<textarea id="qArea" name="qContent" placeholder="Votre titre"></textarea>
			<input type="text" name="qTags" placeholder="Vos tags">
			<input type="submit" value="valider">

			<?php 
				if (!empty($errors_q)){
					echo '<ul class="errors">';
					foreach($errors_q as $error){
						echo '<li>'.$error.'</li>';
					}
					echo '</ul>';
				}
			?>
		</form>
			
	</div>

</section>