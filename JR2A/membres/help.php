<?php
session_start();
if($_POST['submit'] == "Envoyer")
{
	include('../connexion_Bdd/connexionBdd.php');
	$rqst = $bdd->prepare('INSERT INTO aide (`prenom`, `nom`, `email`, `message`, `dateMsg`) VALUES(:prenom, :nom, :email, :message, NOW())');
	$rqst->execute(array(
		'prenom' => $_POST['prenom'],
		'nom' => $_POST['nom'],
		'email' => $_POST['email'],
		'message' => $_POST['message']
	));
	$rqst->closeCursor();
}
if($_SESSION['role'] == 'membre')
{
	include('utilsM.inc.php');
	start_page('Aide');
?>
<style>
textarea
{
	height: 19px;
}
</style>
	<main class="container-fluid">
		<h1 class="text-center">Aide</h1>
		<h2 class="text-center">Demander de l'aide à un administrateur :</h2>
        <div class="row text-center">
			<div class="col-md">
				<form method="post" action="help.php">
					<label> Prénom : 
						<input type="text" name="prenom" required/>
					</label> <br />
					<label> Nom : 
						<input type="text" name="nom" required/>
					</label> <br />
					<label> Email : 
						<input type="text" name="email" required/>
					</label> <br />
					<label> Question : 
						<textarea name="message" required></textarea>					
					</label> <br />
					<input type="submit" name="submit" value="Envoyer" />
				</form>
			</div>
		<div>
	</main>
<?php
}
else
{
	include('utils-inc.php');
	start_page('Aide');
}

end_page();