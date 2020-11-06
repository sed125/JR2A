<?php
include('utils-inc.php');
start_page('Connexion');
?>
	<main class="container-fluid text-center mt-3">
		<form method="post" action="data-processing.php">
			<label>Identifiant :
				<input type="text" name="email" />
			</label> <br />
			<label>Mot de passe :
				<input type="password" name="password" />
			</label> <br /> 
			<input type="checkbox" name="memoriseId" > Mémoriser<br />
			<input type="submit" name="submit" value="Connexion" />
		</form>
		<a class="nav-link text-dark" href="resetPassword.php">Rénitialiser le mot de passe</a>
	</main>



