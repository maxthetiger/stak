<?php 
	include ("inc/atop_home.php");
	include ("inc/ahead.php");
?>





<section id="mainDetails">





	<div class="box buddycloud">
	    <div class="stream"> 

<?php
	$idThis = $_GET['article'];
	$ThisArticle = catchThisArticles($idThis);
	// print_r($ThisArticle);
	// die();
	$tags = getThisTags($idThis);
?>

			<article class="topic">
				<section class="opener">
					<div class="avatar">
						<img src="<?php echo $ThisArticle['avatar']; ?>">
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
		            <h1 class="title"><?php echo $ThisArticle['title']; ?></h1>
		            <p><?php echo $ThisArticle['content']; ?></p>


		            <p><?php 
		            foreach ($tags as $Tkey => $Tvalue):
		            echo '<span class="tagsArticle">' . $Tvalue['name'] . '</span>'; 	
		            endforeach;?></p>
		    <hr>

<section class="answer">
	<div class="avatar"></div>
		<input type="text" placeholder="Commenter cet article...">
		<input type="submit" class="hideSubmit">
	<div class="controls">
	<div class="button small prominent">Post</div>
	</div>
</section>

		        </section>





<div class="hidden">	

	            <section class="comment">
	            	<div class="avatar user6"></div>
					<div class="postmeta">
						<span class="time">3 days</span>
	            	</div>
	            	<span class="name">Mona</span><span class="location">from Cafe Extra</span>
	            	<p>inding a needle in a haystack isn'Who knows? Maybe one day they will be. I like seafood.</p>

<section class="answer">
	<div class="avatar"></div>
		<input type="text" placeholder="Commenter cette réponse...">
		<input type="submit" class="hideSubmit">
	<div class="controls">
	<div class="button small prominent">Post</div>
	</div>
</section>	            

	            </section>



<!-- 	            <section class="comment">
	              <div class="avatar user7"></div>
	              <div class="postmeta">
					<span class="time">3 days</span>
	              </div>
	              <span class="name">Verena</span><span class="location">from Home</span>
	              <p>Finding a needle in a haystack isn't hard when every straw is computerized. I'm really more an apartment person.</p>
	           
<section class="answer">
	<div class="avatar"></div>
		<input type="text" placeholder="Commenter cet article...">
		<input type="submit" class="hideSubmit">
	<div class="controls">
	<div class="button small prominent">Post</div>
	</div>
</section>

	            </section> -->


</div><!-- /hidden -->

<section class="seeMore">
<span id="more">En voir plus</span>
</section>



	   		</article>
	    </div>
	</div>
</section>








<?php 
	//include ("inc/mainDe.php");
	include ("inc/zfoot.php");
	include ("inc/zbottom_home.php");
?>