<?php 
	include ("pages/php/validation_register.php");
	include ("pages/php/validation_login.php");
	include ("pages/php/validation_newPassword_01.php"); ?>


<section id="formulaire_container">
	<div id="signup">
		<form method="POST">
			<header>
				<p> Inscription</p>
			</header>

			<input type="hidden" name="form" value="signUp">
			<input type="text" name="pseudo_r" placeholder="Votre pseudo">
			<input type="email" name="email_1_r" placeholder="Votre email">
			<input type="email" name="email_2_r" placeholder="Confirmer votre email">
			<input type="password" name="pwd_1_r" placeholder="Votre password">
			<input type="password" name="pwd_2_r" placeholder="Confirmer votre password">
			<input type="submit" value="valider">
		</form>
			<?php 
				if (!empty($errors_r)){
					echo '<ul class="errors">';
					foreach($errors_r as $error){
						echo '<li>'.$error.'</li>';
					}
					echo '</ul>';
				}
			?>
	</div>

	<div id="signin">
		<form method="POST">
			<header>
				<p>Connexion</p>
			</header>

			<input type="hidden" name="form" value="signIn">
			<input type="text" name="login_l" placeholder="Pseudo / Email">
			<input type="password" name="pwd_l" placeholder="Votre password">
			<input type="submit" value="me connecter">
		</form>
			<?php 
				if (!empty($errors_l)){
					echo '<ul class="errors">';
					foreach($errors_l as $error){
						echo '<li>'.$error.'</li>';
					}
					echo '</ul>';
				}
			?>
	</div>

	<div id="oublie">
		<p id="forget">Vous avez oublié votre login / password ? <a href="" class="forget_click">> cliquez ici <</a></p>
	</div>	


	<div id="remember">
		<form method="POST">
			<input type="hidden" name="form" value="remember">
			<input type="email" name="email_f" placeholder="Votre email">
			<input type="submit" value="">
		</form>
			<?php 
				if (!empty($errors_f)){
					echo '<ul class="errors">';
					foreach($errors_f as $error){
						echo '<li>'.$error.'</li>';
					}
					echo '</ul>';
				}
			?>
	</div>

</section>