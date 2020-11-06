<?php
session_start();
if($_POST['ajouter'] == 'Ajouter')
{
    include('../../connexion_Bdd/connexionBdd.php');
    $rqst = $bdd->prepare('INSERT INTO `post`(`titre`, `message`, `dateHeure`, `pseudo`) VALUES (:titre, :msg, NOW(), :pseudo)');
    $rqst->execute(array(
        'titre'=>$_POST['titre'],
        'msg'=>$_POST['msg'],
        'pseudo'=>$_SESSION['pseudo']
    ));
    $rqst->closeCursor();
    header('location: post.php');
}
include('utils-interface-inc.php');
startPage('addPost.php');
?>
<div class="page-content p-5 text-center" id="content">
    <form method="post" action="addPost.php">
        <label>Titre
            <input type="text" name="titre" />
        </label> <br />
        <label>Message :
            <textarea name="msg">
            </textarea>
        </label>
        <input type="submit" name="ajouter" value="Ajouter" />
    </form>
</div>


<?php

