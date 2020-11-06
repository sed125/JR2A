<?php
session_start();
include('../../connexion_Bdd/connexionBdd.php');
if($_POST['add'] == 'Envoyer')
{
    $rqst = $bdd->prepare('INSERT INTO `forum` (`user`, `question`, `details`, `dateHeure`) VALUES (:pseudo, :question, :details, NOW())');
    $rqst->execute(array(
        'pseudo'=>$_SESSION['pseudo'],
        'question'=>$_POST['question'],
        'details'=>$_POST['details']
    ));
    $rqst->closeCursor();
    header('location: forum.php'); 
}
if($_POST['repondre'] == 'Répondre' && isset($_GET['idQuest']))
{
    $rqst = $bdd->prepare('INSERT INTO `reponseForum` (`user`, `reponse`, `idQuestion`, `dateHeure`) VALUES (:user, :reponse, :idQuest, NOW())');
    $rqst->execute(array(
            'user'=>$_SESSION['pseudo'],
            'reponse'=>$_POST['reponse'],
            'idQuest'=>$_GET['idQuest']
            ));
    $rqst->closeCursor();
    header('location: forum.php');   
}
// Supprimer une question
if(isset($_GET['idDelQuest']))
{
    $rqstDel = $bdd->prepare('DELETE FROM `forum` WHERE id = :id');
    $rqstDel->execute(array(
        'id'=>$_GET['idDelQuest']
    ));
    $rqstDel->closeCursor();
    header('Location: forum.php');
}
// Supprimer une reponse
if(isset($_GET['idDelRep']))
{
    $rqstDel = $bdd->prepare('DELETE FROM `reponseForum` WHERE id = :id');
    $rqstDel->execute(array(
        'id'=>$_GET['idDelRep']
    ));
    $rqstDel->closeCursor();
    header('Location: forum.php');
}
?>