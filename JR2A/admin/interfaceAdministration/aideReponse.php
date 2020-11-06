<?php
session_start();
if($_POST['repondre'] == 'Repondre' && isset($_SESSION['id']))
{
    // $date = NOW();
    include('../../connexion_Bdd/connexionBdd.php');
    $rqst = $bdd->prepare('INSERT INTO reponseAide (`reponse`, `dateHeure`, `idQuestion`, `idAdmin`) 
                            VALUES (:reponse, NOW(), :idQuestion, :idAdmin)');
    $rqst->execute(array(
        'reponse' => $_POST['reponse'],
        'idQuestion' => $_GET['idRep'],
        'idAdmin' => $_SESSION['id']
    ));
    $rqst->closeCursor();
    header('location: aide.php');
}

?>