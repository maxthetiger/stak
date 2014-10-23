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

		<article class="topic">
			<section class="opener">
				<div class="avatar">
					<img src="http://img4.wikia.nocookie.net/__cb20140425020652/prowrestling/images/e/e9/Tigre_Uno_img_2404.jpg">
				</div>
				<div class="postmeta">
					<span class="time">3 days</span>
	            </div>
	            <span class="name"><?php echo $value['pseudo']; ?></span><span class="location">from <?php echo $value['location']; ?></span>
	            <p><?php echo $value['title']; ?></p>
	            <p><?php 
	            foreach ($tags as $Tkey => $Tvalue):
	            echo '<a class="tagsArticle">' . $Tvalue['name'] . '</a>'; 	
	            endforeach;?></p>
	        </section>
	    </article>

<?php
endforeach;
?>

	    </div>
	</div>


</section>