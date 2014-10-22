<div id="main_container">
	<div id="infos_profil" class="container">
		<div id="fiche">
			<div class="left" id="profil_img">
				<div id="pseudo_profil"><input class="pseudo_in" type="text" value="Maxthetiger">
					<div id="status">
						<span class="in">In</span> | 
						<span class="out">Out</span>
					</div>
				</div>
				<div id="score">5,376</div>
				
				<!-- <div class="infos_small" id="locate"><input type="text" id="location" value="Paris, France" <?php //echo $location; ?> ></div> -->
				<div class="infos_small" id="locate"><input type="text" id="location" value="Paris, France"></div>
				
				<!-- <div class="infos_small" id="work"><input type="text" value="Mangeur de Gauffre" <?php //echo $metier; ?> ></div> -->
				<div class="infos_small" id="work"><input type="text" value="Mangeur de Gaufres"></div>
				
				<span id="avatar">
					<img src="http://www.catsthatlooklikehitler.com/kitler/pics/kitler1927.jpg">
						<input type="file" value="avatar" name="avatar" value="avatar" <?php // echo $avatar; ?> >
					<!-- <div id="pseudo_profil"><input class="pseudo_in" type="text" value="Maxthetiger" <?php //echo $pseudo; ?>> -->
				</span>
				
				<div class="url_links">
					<div class="urls">
						<span class="link">Github :</span>
						<!-- <span class="link_url"><input class="link_in" type="text" value="http://blablacar.com" <?php //echo $github; ?> ></span> -->
						<span class="link_url"><input class="link_in" type="text" value="http://blablacar.com"></span>
					</div>	
					
					<div class="urls">
						<span class="link">Website :</span>
						<!-- <span class="link_url"><input class="link_in" type="text" value="http://www.maxthetiger.com"<?php //echo $webSite; ?> ></span> -->
						<span class="link_url"><input class="link_in" type="text" value="http://www.maxthetiger.com"></span>
					</div>
					
					<div class="urls">
						<span class="link">Email :</span>
						<!-- <span class="link_url"><input class="link_in" type="mail" value="maxthetiger@gmail.com" <?php //echo $email; ?> ></span> -->
						<span class="link_url"><input class="link_in" type="mail" value="maxthetiger@gmail.com"></span>
					</div>	
				</div>
			</div>

			<div class="right">
				<div id="profil_info">
					<header>Description</header>
					<div>
						<textarea name="description" maxlenght="450">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</textarea>
					</div>
				</div>
				<div class="passes">
					<span class="pass">Password : </span>
					<span class="pass_url"><input type="password" class="password" id="pwd" placeholder="Votre password"></span>
				</div>
				<div class="passes">
					<span class="pass">Confirm Password : </span>
					<span class="pass_url"><input type="password" class="password" id="pwdBis" placeholder="Confirmer votre password"></span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <form>
	<header><p>Profil</p></header>
	<div id="avatar">
		<div id="pics"></div>
		<input type="file" value="avatar" name="avatar" >
	</div>				
	<input type="text" name="ville" placeholder="Ville">
	<input type="text" name="metier" placeholder="Métier">
	<input type="text" name="website" placeholder="Site Web">
	<input type="text" name="github" placeholder="Github">
	<textarea name="description" placeholder="Présentez-vous ici ..."></textarea>
	<input type="submit" value="valider">
</form> -->