
<?php 
if (!empty($page) &&  ($page == "question" )):
	echo '
	<nav id="nav">
		<a href="#" class="active">NewStakode</a>
		<a href="#">Tuts +</a>
		<a href="#">Carrière</a>
		<a href="#">Actu / Evènements</a>
	</nav>';
	else: 
		echo '
	<nav id="nav">
		<a href="#" class="active">NewStakode</a>
		<a href="#">Tuts +</a>
		<a href="#">Carrière</a>
		<a href="#">Actu / Evènements</a>
	</nav>';

endif; ?>
<!-- 
<nav id="nav">
	<a href="#" class="active">NewStakode</a>
	<a href="#">Tuts +</a>
	<a href="#">Carrière</a>
	<a href="#">Actu / Evènements</a>
</nav> -->