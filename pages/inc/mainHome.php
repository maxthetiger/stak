<!-- <section id="mainHome">
	<h1>Les derniers articles</h1>

 -->

<section id="homeAsk">

	<a id="askQuestion" href="<?php
	if (userIsLogged()){
		echo "?page=question";
	} else {
		echo "?page=register";
	}

?>"> Poser une nouvelle question</a>

<!-- 
	<article id="artThree">
		<a href="?page=details">details</a>
	</article>
</section> -->



	<div class="box buddycloud">
	      <div class="stream"> 

<?php
	$articles = catchAllArticles();
	foreach ($articles as $key => $value):
	$idThis = $value['articleID'];
	$tags = getThisTags($idThis);
?>
	<a href="?page=details&amp;article=<?php echo $idThis; ?>">
		<article class="topic">
			<section class="opener">
				<div class="avatar">
					<img src="<?php echo $value['avatar']; ?>">
				</div>
				<div class="postmeta">
					<span class="time">
						<?php echo $value['dateCreated']; ?>
					</span>
	            </div>
	            <span class="name">
	            	<?php echo ucfirst($value['pseudo']); ?>
	            </span>
	            <span class="location">
	            	from <?php echo $value['location']; ?>
	            </span>
	            <h1 class="titleHome"><?php echo $value['title']; ?></h1>
	            <p><?php 
	            foreach ($tags as $Tkey => $Tvalue):
	            echo '<span class="tagsArticle">' . $Tvalue['name'] . '</span>'; 	
	            endforeach;?></p>
	        </section>
	    </article>
	</a>
<?php
endforeach;
?>

	    </div>
	</div>


</section>