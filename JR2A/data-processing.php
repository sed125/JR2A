<?php
session_start();

		// Inscription
if($_POST['submit'] == 'Valider')
{  
	include('connexion_Bdd/connexionBdd.php');
    $passwo = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rqst =$bdd->prepare('SELECT COUNT(*) FROM membres WHERE email = ?');
    $rqst->execute(array($_POST['email']));
    $array = $rqst->fetch();
    $rqst->closeCursor();    

    // $photo = $_FILES['photo'];
    if (isset($_POST['email'])) 
    {
        if(!($array[0] == 0))
        {
            echo 'Email déja utilisé';
        }       
        else
        {
            if($_POST['password'] != $_POST['confirmPassw'])
            {
                echo '<p>Votre mot de passe doit être le même que celui de la confirmation.</p>';
            }
            else
            {
                $rqst = $bdd->prepare('INSERT INTO membres (`email`, `prenom`, `nom`, `pass`, `pseudo`, `telephone`, `role`, `date_Inscription`) VALUES (:email, :prenom, :nom, :password, :pseudo, :telephone, :role, CURDATE())');
                $rqst->execute(array(
                    'email' => $_POST['email'],
                    'prenom' => $_POST['prenom'],
                    'nom' => $_POST['nom'],
					'password' => $passwo,
					'pseudo' => $_POST['pseudo'],
                    'telephone' => $_POST['tel'],
                    'role' => 'membre',
                ));
                echo 'inscription réussie';
                echo '<br><a href="connexion.php">Connexion</a>';
                $rqst->closeCursor();
            }
        } 
    }      
}

// Connexion
if($_POST['submit'] == 'Connexion')
{
	include('connexion_Bdd/connexionBdd.php');
	//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id, prenom, email, pass, pseudo, role FROM membres WHERE email = ?');
	$req->execute(array($_POST['email']));
	$result = $req->fetch();
	$req->closeCursor();
	// Comparaison du pass envoyé via le formulaire avec la base

	$memoriser = $_POST['memoriseId'];
	$passCorrect = password_verify($_POST['password'], $result['pass']);
	if (!$result)
	{
		echo '<p class="text-center mt-3">Mauvais identifiant ou mot de passe. <br /> <a href="connexion.php">Retour a la page de connexion</a></p>';
	}
	else
	{
		if ($passCorrect && $result['role'] == 'admin') 
		{ 
			$_SESSION['id'] = $result['id'];
			$_SESSION['prenom'] = $result['prenom'];
			$_SESSION['pseudo'] = $result['pseudo'];
			$_SESSION['role'] = $result['role'];
			if($memoriser)
			{
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['mdp'] = $result['pass'];
			}
			header('location: admin/interfaceAdministration/interface.php');	
		}
		if($passCorrect && $result['role'] == 'membre')
		{
			$_SESSION['id'] = $result['id'];        
			$_SESSION['prenom'] = $result['prenom'];
			$_SESSION['pseudo'] = $result['pseudo'];   
			$_SESSION['role'] = $result['role'];   
			if($memoriser) 
			{
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['mdp'] = $result['pass'];
			}
			header('location: membres/espaceMembre.php');
		}
		elseif($passCorrect && $result['role'] === 'guest')
		{
			header('location: membres/espaceMembre.php');
		}
		else
		{
			echo '<p class="text-center mt-3">Mauvais identifiant ou mot de passe. <br /> <a href="connexion.php">Retour a la page de connexion</a></p>';
		}
	}
}