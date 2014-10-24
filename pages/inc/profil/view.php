<?php $user = $_SESSION['user']; 
?>



<div id="main_container">
	<div id="infos_profil" class="container">
		<div id="fiche">
			<div class="left" id="profil_img">
				<span id="avatar">
					<img src="avatar/<?php echo $user['pseudo'] . ".jpg"; ?>">
				</span>
				<div id="pseudo_profil"><?php echo $user['pseudo']; ?>
					<div id="status">
						<span class="in">In</span> | 
						<span class="out">Out</span>
					</div>
				</div>
				<div id="score"><?php echo $user['score']; ?></div>
				<div class="infos_small" id="locate">
					<?php echo $user['location']; ?>
				</div>
				<div class="infos_small" id="work">
					<?php echo $user['metier']; ?>
				</div>
				<div class="urls">
					<span class="link">Github :</span>
					<span class="link_url">
						<?php echo $user['github']; ?>
					</span>
				</div>	
				<div class="urls">
					<span class="link">Website :</span>
					<span class="link_url">
						<?php echo $user['webSite']; ?>
					</span>
				</div>
			</div>

			<div class="right" id="profil_info">
				<header>Description</header>
				<div><?php echo $user['details']; ?></div>
			</div>
		</div>
		<div id="reponses" class="left">
			<header class="header_section">
				<span class="nombre">115</span>Réponses</header>
			<main class="main">
				<ul>
					<?php 
					$afficheMesReponses = selectMyReponses();

					foreach ($afficheMesReponses as $reponses) {
							$str = $reponses['reponse'];
							$repAffiche = tronque($str, $nb = 50);

					echo '<li><a href="' . '?page=details&amp;article=' . $reponses['id_article'] . '">' . $repAffiche . '</a></li>';
					}
					?>
				</ul>
			</main>
			<div class="more"><a href="?page=mesreponses">>> i++</a></div>
		</div>

		<div id="questions" class="left">
			<header class="header_section"><span class="nombre">327</span>Questions</header>
			<main class="main">
				<ul>
					<?php 
					$afficheMesQuestions = selectMyQuestions();

					foreach ($afficheMesQuestions as $question) {
					echo '<li><a href="' . '?page=details&amp;article=' . $question['articleID'] . '">' . $question['title'] . '</a></li>';
					}
					?>
				</ul>
			</main>
			<div class="more"><a href="?page=mesquestions">>> i++</a></div>
		</div>

		<div class="left">
			<header class="header_section"><span class="nombre">5,376</span>Points</header>
			<main class="main">
				<ul>
					<li><a href=""><span>+5</span> Réponse à la question 1</a></li>
					<li><a href=""><span>+2</span> Comment allumer la lumière</a></li>
					<li><a href=""><span>+50</span> Best reponse à la question</a></li>
					<li><a href=""><span>+2</span> Difficile de compter tout ces points</a></li>
					<li><a href=""><span>-2</span> Tu as voté contre moi vilain !</a></li>
				</ul>
			</main>
			<div class="more"><a href="#">>> i++</a></div>
		</div>

		<div class="left">
			<header class="header_section"><span class="nombre">23</span>Favoris</header>
			<main class="main">
				<ul>
					<li><a href="">Super voici mes favoris</a></li>
					<li><a href="">Tu aimes cette musique</a></li>
					<li><a href="">Vive le pop-corn</a></li>
					<li><a href="">Il est mignon Mr. Pignon</a></li>
					<li><a href="">Voici mon préféré</a></li>
				</ul>
			</main>
			<div class="more"><a href="#">>> i++</a></div>
		</div>
	</div>
</div>