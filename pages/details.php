<?php 
	include ("inc/atop_home.php");
	include ("inc/ahead.php");
	include ("pages/php/validation_comment.php");
	include ("pages/php/validation_like.php");
	include ("pages/php/validation_commentRep.php");
	include ("pages/php/validation_reponse.php");
?>

<section id="mainDetails">
	<div class="box buddycloud">
	    <div class="stream"> 
		<?php
			$idThis = $_GET['article'];
			$ThisArticle = catchThisArticles($idThis);
			$tags = getThisTags($idThis);
		?>
			<article class="topic">
				<section class="opener">
					<div class="avatar">
						<img src="avatar/<?php echo $ThisArticle['avatar']; ?>">
					</div>
					<div class="postmeta">
						<span class="time">
							<?php echo $ThisArticle['dateCreated']; ?>
						</span>
		            </div>
		            <span class="name">
		            	<?php echo ucfirst($ThisArticle['pseudo']); ?>
		            </span>
		            <span class="location">
		            	from <?php echo $ThisArticle['location']; ?>
		            </span>
		            <span class="name retour" >
		            	<?php echo $ThisArticle['score']; ?>
		            </span>
		            <h1 class="title"><?php echo $ThisArticle['title']; ?></h1>
		            <p><?php echo $ThisArticle['content']; ?></p>
		            <p><?php foreach ($tags as $Tkey => $Tvalue):
		            echo '<span class="tagsArticle">' . $Tvalue['name'] . '</span>'; 	
		            endforeach;?></p>
		            <!-- <span><a href="">Like</a></span>
		            <span><a href="">Hate</a></span> -->


		            <form method="POST" >
						<div class="formCom">
							<label><input type="radio" name="Like" value="like">Like</label>
							<label><input type="radio" name="Like" value="unlike">UnLike</label>
							<input type="hidden" name="form" value="liking">
							<input type="hidden" name="articleID" value="<?php echo $ThisArticle['articleID']; ?>">
							<input type="submit" value="A vote" class="vote" style="width: 75px; padding: 2px 5px;">
						</div>
							<div>Note de l'article : <?php echo $ThisArticle['note']; ?></div>
					</form>


		   		<hr>



					<section class="answer">
						<div class="avatar"></div>
							<form method="POST" >
								<div class="formCom">
									<input type="text" name="articleComment" placeholder="Commenter cet article...">
									<input type="hidden" name="form" value="commentArticle">
									<input type="hidden" name="articleID" value="<?php echo $ThisArticle['articleID']; ?>">
									<input type="submit" class="hideSubmit">
								</div>
								<?php 
									if (!empty($errors_ca)){
										echo '<ul class="errors">';
										foreach($errors_ca as $error){
											echo '<li>'.$error.'</li>';
										}
										echo '</ul>';
									}
								?>
							</form>

							<?php 
								$thisArticleComment = afficheArticleComment($idThis);
								
								// print_r($thisArticleComment);
								// die();
								if (!empty($thisArticleComment)){
									echo '<ul class="commentaires">';
									foreach($thisArticleComment as $comArt){
										echo '<li class="pseudoCom">'.$comArt['pseudo']. ' le ' . $comArt['dateCreated'] . '</li>';
										echo '<li class="comCom">'.$comArt['comment'].'</li>';
									}
										echo '</ul>';
								}	
								?>
					</section>
				</section>



			<?php 
			$thisArticleReponse = afficheArticleReponse($idThis);

			if(!empty($thisArticleReponse)): ?>


					<div class="hidden">

						<?php foreach($thisArticleReponse as $repArt): ?>

	            		<section class="comment">
			            	<div class="avatar">
			            		<img src="avatar/<?php echo $repArt['avatar']; ?>"></div>
							<div class="postmeta">
								<span class="time"><?php echo $repArt['dateCreated']; ?></span>
			            	</div>
			            	<span class="name"><?php echo $repArt['pseudo']; ?></span>
			            	<span class="location">from <?php echo $repArt['location']; ?></span>
			            	<span class="name retour" ><?php echo $repArt['score']; ?></span>
			            	<p><?php echo $repArt['reponse']; ?></p>


							<section class="answer">
								<div class="avatar"></div>
								<form method="POST" >
									<div class="formCom">
										<input type="text" name="commentReponse" placeholder="Commenter cette reponse...">
										<input type="hidden" name="form" value="reponseComment">
										<input type="hidden" name="reponseID" value="<?php echo $repArt['reponseID']; ?>">
										<input type="submit" class="hideSubmit">	
									</div>
								<?php 
								if (!empty($errors_cr)){
									echo '<ul class="errors">';
									foreach($errors_cr as $error){
										echo '<li>'.$error.'</li>';
									}
									echo '</ul>';
								}
								?>

								</form>	
								
								<?php 
								$reponseID = $repArt['reponseID'];
								$thisReponse = afficheReponseComment($type, $comment, $reponseID);	
								/*print_r($thisReponse);*/
									if (!empty($thisReponse)){
										echo '<ul class="commentaires">';
										foreach($thisReponse as $comRep){
											echo '<li class="pseudoCom">'.$comRep['pseudo']. ' le ' . $comRep['dateCreated'] . '</li>';
											echo '<li class="comCom">'.$comRep['comment'].'</li>';
										}
										echo '</ul>';
									}	
								?>
							</section>	            
						</section>

						<?php endforeach; ?>

					</div><!-- /hidden -->

					<section class="seeMore">
						<span id="more">En voir plus</span>
					</section>

					<?php endif; ?>
	   		</article>
	    </div>
	</div>
</section>



<div id="reponses">
	<section id="formulaire_container">
		<div id="reponse">
			<form method="POST">
				<header>
					<p>Répondre à cet article</p>
				</header>
				<input type="hidden" name="articleID" value="<?php echo $ThisArticle['articleID']; ?>">
				<input type="hidden" name="form" value="reponseArticle">
				<textarea id="qArea" name="aContent" placeholder="Votre réponse"></textarea>
				<input type="submit" value="valider">

				<?php 
					if (!empty($errors_ra)){
						echo '<ul class="errors">';
						foreach($errors_ra as $error){
							echo '<li>'.$error.'</li>';
						}
						echo '</ul>';
					}
				?>
			</form>
		</div>
	</section>
</div>




<?php 
	//include ("inc/mainDe.php");
	include ("inc/zfoot.php");
	include ("inc/zbottom_home.php");
?>