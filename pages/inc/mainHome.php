<section id="mainHome">
	<h1>Les derniers articles</h1>


	<a href="<?php
	if (userIsLogged()){
		echo "?page=question";
	} else {
		echo "?page=register";
	}

?>"> Poser une nouvelle question</a>

	<article id="artOne">
		<a href="?page=reset">reset</a>
	</article>

	<article id="artTwo">
		<a href="?page=profil">profil</a>
	</article>

	<article id="artThree">
		<a href="?page=details">details</a>
	</article>
</section>