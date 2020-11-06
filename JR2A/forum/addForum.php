<?php
session_start();
if($_POST['add'] == 'Envoyer' && isset($_SESSION['prenom']))
{
    include('connexion_Bdd/connexionBdd.php');
    $rqst = $bdd->prepare('INSERT INTO forum (user, question, details, dateHeure) VALUES (:user, :quest, :details, NOW())');
    $rqst->execute(array(
        'user'=>$_SESSION['pseudo'],
        'quest'=>$_POST['question'],
        'details'=>$_POST['details']
    ));
    $rqst->closeCursor();
    header('location: forum.php');
}

?>
<form method="post" action="addForum.php">
    <label> Question : 
        <input type="text" name="question" /> 
    </label> <br />
    <label>Détail : 
        <textarea name="details">
        </textarea>
    </label> <br />
    <input type="submit" value="Envoyer" name="add" />
</form>
<?php

?>