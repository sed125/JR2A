<?php
include('utils-inc.php');
start_page('Rénitialiser le mot de passe');
if($_POST['submit'] == 'Rénitialiser le mot de passe')
{
    include('connexion_Bdd/connexionBdd.php');
    $rqst = $bdd->prepare('SELECT id, email FROM membres WHERE email = ?');
    $rqst->execute(array($_POST['email']));
    $mailBdd = $rqst->fetch();
    $rqst->closeCursor();
    if($mailBdd['email'] == $_POST['email'])
    {
        $headers = 'From: sedinsedir@alwaysdata.net';
        
        $msg = 'Vous pouvez rénitialiser votre mot de passe ici : https://sedinsedir.alwaysdata.net/crudUtilisateurs/resetPassword.php?idResetPass='.$mailBdd['id'];
        if(mail($_POST['email'], 'Rénitialiser le mot de passe', $msg, $headers))
        {
            header('location: connexion.php');
        }
        else
        {
            echo 'Quelque chose ne va pas';
        }  
        

    }
    else
    {
        echo 'Email introuvable. <br /><a href="inscription.php">S\'inscrire?</a>';

    }
}
?>
    <form method="post" action="resetPassword.php" class="mt-4 text-center">
        <label>Email :
            <input type="email" name="email" />
        </label>
        <input type="submit" name="submit" value="Rénitialiser le mot de passe" />
    </form>


