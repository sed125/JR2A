<?php
session_start();
if($_SESSION['role'] === 'membre')
{
	include('../connexion_Bdd/connexionBdd.php');
	$rqst = $bdd->prepare('SELECT email, pass FROM membres WHERE id = ?');
	$rqst->execute(array($_SESSION['id']));
	$valeurEgale = $rqst->fetch();
	$rqst->closeCursor();

	$rqst = $bdd->prepare('SELECT COUNT(*) FROM membres WHERE email = ?');
	$rqst->execute(array($_POST['email']));
	$array = $rqst->fetch();
	$rqst->closeCursor();

	$rqst = $bdd->prepare('SELECT pass FROM membres WHERE id = :id');
	$rqst->execute(array(
		'id' => $_SESSION['id']
	));
	$pass = $rqst->fetch();
	$rqst->closeCursor();
	// Update info user
	if ($_POST['update'] == 'Modifier les paramètres de mon compte' && password_verify($_POST['password'], $pass['pass']))
	{
		if ($valeurEgale['email'] == $_POST['email'] OR empty($_POST['newPassword']) && empty($_POST['confirmPassw'])) 
		{
			$rqst = $bdd->prepare('UPDATE membres SET prenom = :prenom, nom = :nom, telephone = :telephone, role = :role WHERE id = :id');
			$rqst->execute(array(
				'id' => $_SESSION['id'],
				'prenom' => $_POST['prenom'],
				'nom' => $_POST['nom'],
				'telephone' => $_POST['tel'],
				'role' => $_SESSION['role']
			));
			$rqst->closeCursor();
		}
		elseif($array[0] == 0) 
		{
			$rqst = $bdd->prepare('UPDATE membres SET email = :email, prenom = :prenom, nom = :nom, pass = :password, telephone = :telephone, role = :role WHERE id = :id');
			$rqst->execute(array(
				'id' => $_SESSION['id'],
				'email' => $_POST['email'],
				'prenom' => $_POST['prenom'],
				'nom' => $_POST['nom'],
				'password' => $passwo,
				'telephone' => $_POST['tel'],
				'role' => $_POST['role']
			));
			$rqst->closeCursor();;
		}
		else
		{
			echo 'Adresse email déja utilisée';
		}
	}
	include('utilsM.inc.php');
	start_page('Paramètres du compte');
	$id = $_SESSION['id'];
	$getInfos = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
	$getInfos->execute(array(
			'id' => $id
	));
    $listInfos = $getInfos->fetch();

?>
<center class="mt-2">
	<form method="post" action="parametreDuCompte.php" class="mb-2">
		<label>Entrez votre prénom :
			<input type="text" name="prenom" value="<?php echo $listInfos['prenom'] ?>" autocomplete="off" ><br>
		</label> <br />
		<label>Entrez votre nom :
			<input type="text" name="nom" value="<?php echo $listInfos['nom'] ?>" autocomplete="off" ><br>
		</label> <br />
		<label>Téléphone
			<input type="text" name="tel" value="<?php echo $listInfos['telephone'] ?>" autocomplete="off" required><br>
		</label> <br />
		<label>E-Mail
			<input type="text" name="email" value="<?php echo $listInfos['email'] ?>" autocomplete="off" ><br>
		</label> <br />
		<label>Entrez votre mot de passe actuel :
			<input type="password" name="ancienPassword" required placeholder="Mot de passe" autocomplete="off">
		</label> <br />
		<label>Entrez votre nouveau mot de passe :
			<input type="password" name="password" placeholder="Mot de passe" autocomplete="off"><br>
		</label> <br />
		<label>Confirmez votre nouveau mot de passe :
			<input type="password" name="confirmPassw" placeholder="Mot de passe" autocomplete="off"><br>
		</label> <br />			
		<input type="submit" name="update" value="Modifier les paramètres de mon compte">
		<input type="reset" name="effacer" value="Effacer">
	</form>
	<a href="<?php echo '../crudUtilisateurs/upDel.php?idDel='.$_SESSION['id']; ?>" class="text-dark">Supprimer le compte</a>
</center>
<?php
    end_page();
}
else
{
	header('location: ../index.php');
}