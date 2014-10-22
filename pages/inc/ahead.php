<header>
	<div id="header">
		<a href="index.php"><div id="logo"></div></a>

		<?php if (userIsLogged()): ?>
				<a href="?page=logout" class="connexion">Logout</a>
				<a href="?page=profil" class="connexion">Mon profil</a>
		<?php endif; ?>

		<?php if (!userIsLogged()): ?>
				<a href="?page=register" class="connexion">Sign up</a>
				<a href="?page=register" class="connexion">Sign in</a>
		<?php endif; ?>
			
		<div id="search">
			<form>
				<div id="searchbar">
					<input type="text" placeholder="Rechercher" id="recherche">
					<div id="search_submit">
						<input type="submit" id="search_btn" value="">
					</div>
				</div>
			</form> 
		</div>
	</div>
</header>