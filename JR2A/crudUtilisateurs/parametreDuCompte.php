<?php
session_start();
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
		if($_SESSION['role'] == 'admin')
		{
			header('location : ../admin/interfaceAdministration/parametreDuCompte.php');
		}
		if($_SESSION['role'] == 'membre')
		{
			header('location : ../membres/parametreDuCompte.php');
		}
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
		$rqst->closeCursor();
		if($_SESSION['role'] == 'admin')
		{
			header('location : ../admin/interfaceAdministration/parametreDuCompte.php');
		}
		if($_SESSION['role'] == 'membre')
		{
			header('location : ../membres/parametreDuCompte.php');
		}
	}
	else
	{
        echo 'Adresse email déja utilisée';
	}
}