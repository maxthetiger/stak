<?php 
	$user = $_SESSION['user'];
	include ("pages/php/validation_profil.php");

		if (!empty($_FILES)){

		$accepted = array("image/jpeg", "image/jpg", "image/png");

		$tmp_name = $_FILES['avatar']['tmp_name'];

		$parts = explode(".", $_FILES['avatar']['name']);
		$extension = end($parts);
		$filename = $user['pseudo'] . "." . $extension;
		$destination = "avatar/" . $filename;

		// Retourne le type mime
		$finfo = finfo_open(FILEINFO_MIME_TYPE); 
		$mime = finfo_file($finfo, $tmp_name);
		finfo_close($finfo);

		//mime type accepté ici ???
		if (in_array($mime, $accepted)){
			move_uploaded_file($tmp_name, $destination);

			//manipulation de l'image
			//avec SimpleImage
			require("pages/SimpleImage.php");

			$img = new stackode\SimpleImage($destination);
		}
	}
/*	print_r($_POST);
	print_r($_SESSION);*/
?>

<div id="main_container">
	<div id="infos_profil" class="container">
		<form enctype="multipart/form-data" id="fiche" method="POST" >
			<div class="left" id="profil_img">
				<span id="avatar">
					<label>
						<!-- <img id="img" src="#"> -->
	 					<img id="img" src="avatar/<?php echo $user['pseudo'] . ".jpg"; ?>">
							<input type="file" id="avatar" name="avatar" value="avatar" onchange="readURL(this);">
					</label>
				</span>
				<div id="pseudo_profil">
					<input class="pseudo_in" type="text" name="pseudo"  value ="<?php echo $user['pseudo']; ?>" placeholder="<?php echo $user['pseudo']; ?>" >
			<!-- <div id="pseudo_profil">
					<input class="pseudo_in" type="text" value="Maxthetiger"> -->
					<div id="status">
						<span class="in">In</span> | 
						<span class="out">Out</span>
					</div>
				</div>

				<div id="score">5,376</div>
				<div class="infos_small" id="locate">
					<input type="text" id="location" name="location" value="<?php echo $user['location']; ?>" placeholder="Ou êtes-vous?">
				</div>
				<!-- <div class="infos_small" id="locate">
					<input type="text" id="location" value="Paris, France">
				</div> -->
				
				<div class="infos_small" id="work">
					<input type="text" name="metier" value="<?php echo $user['metier']; ?>" placeholder="Quel est votre Métier">
				</div>
				<!-- <div class="infos_small" id="work">
					<input type="text" value="Mangeur de Gaufres">
				</div> -->
								
				<div class="url_links">
					<div class="urls">
						<span class="link">Github :</span>
						<span class="link_url">
							<input class="link_in" type="text" name="github" value="<?php echo $user['github']; ?>" placeholder="Avez-vous Github ?">
						</span>
						<!-- <span class="link_url">
							<input class="link_in" type="text" value="http://blablacar.com">
						</span> -->
					</div>	
					
					<div class="urls">
						<span class="link">Website :</span>
						<span class="link_url">
							<input class="link_in" type="text" name="webSite" value="<?php echo $user['webSite']; ?>" placeholder="Votre Site Web ">
						</span>
						<!-- <span class="link_url">
							<input class="link_in" type="text" value="http://www.maxthetiger.com">
						</span> -->
					</div>
					
					<div class="urls">
						<span class="link">Email :</span>
						<span class="link_url">
							<input class="link_in" type="mail" name="email" value="<?php echo $user['email']; ?>" placeholder="Votre adresse mail">
						</span>
						<!-- <span class="link_url">
							<input class="link_in" type="mail" value="maxthetiger@gmail.com">
						</span> -->
					</div>	
				</div>
			</div>

			<div class="right">
				<div id="profil_info">
					<header>Description</header>
					<div>
						<textarea name="details" maxlength="500" placeholder="Présentez-vous ici (500 caractères max)"><?php echo $user['details']; ?></textarea>
						<!-- <textarea name="description" maxlength="500" placeholder="Présentez-vous ici (500 caractères max)">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea> -->
					</div>
				</div>
				<div id="passs">
					<div class="passes">
						<span class="pass">Password : </span>
						<span class="pass_url">
							<input type="password" class="password" id="pwd" name="pwd" placeholder="Votre password">
						</span>
					<!-- <span class="pass_url">
							<input type="password" class="password" id="pwd" placeholder="Votre password">
						</span> -->
					</div>

					<div class="passes">
						<span class="pass">Confirm Password : </span>
						<span class="pass_url">
							<input type="password" class="password" id="pwdBis" name="" placeholder="Confirmer votre password">
						</span>
					</div>
					<!-- <input type="submit" value="!" id="subPwd"> -->
				</div>
			</div>
				<input type="submit" value="Valider" id="subAll">
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
</div>
