<?php
session_start();
include('../connexion_Bdd/connexionBdd.php');

$pseudo = $_SESSION['pseudo'];
$msg = $_POST['message'];
if(isset($pseudo, $msg))
{
    $rqst = $bdd->prepare('INSERT INTO chat (`pseudo`, `dateHeure`, `message`) VALUES(:pseudo, NOW(), :msg)');
    $rqst->execute(array(
        'pseudo' => $pseudo,
        'msg' => $msg
    ));
    $rqst->closeCursor();
}
if($_SESSION['role'] == 'admin')
{
    header('location: ../admin/interfaceAdministration/chat.php');
}
elseif($_SESSION['role'] == 'membre')
{
    header('location: ../membres/espaceMembre.php');
}
else
{
    header('location: ../index.php');
}
