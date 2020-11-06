<?php
include('utils-inc.php');
start_page('Inscription');
?>
		<main class="container-fluid text-center">
			<h1>Formulaire d'inscription</h1>
			<form method="post" action="data-processing.php">
				<label>Prénom :
					<input type="text" name="prenom" />
				</label> <br />
				<label>Nom :
					<input type="text" name="nom" />
				</label> <br />
				<label>Pseudo :
					<input type="text" name="pseudo" />
				</label> <br />:
				<label>Téléphone :
					<input type="text" name="tel" required />
				</label>
				<label>E-Mail :
					<input type="text" name="email" required />
				</label> <br />
				<label>Entrez votre mot de passe :
					<input type="password" name="password" required />
				</label> <br />
				<label>Confirmez votre mot de passe :
					<input type="password" name="confirmPassw" required />
				</label> <br />
				<!-- <div id="subtab">
					<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
					<input type="file" name="photo" /> <p>Photo de profil</p>
				</div> -->
				<input type="submit" name="submit" value="Valider" />
				<input type="reset" name="effacer" value="Effacer" />
			</form>
		</main>
