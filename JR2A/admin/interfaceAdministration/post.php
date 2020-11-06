<?php
include('utils-interface-inc.php');
startPage('Post');
include('../../connexion_Bdd/connexionBdd.php');
if($_POST['sub'] == 'Envoyer')
{
    $rqst = $bdd->prepare('INSERT INTO `commentairesPost`(`commentaires`, `idPost`, `pseudo`, `dateHeure`) 
        VALUES (:com, :idPost, :pseudo, NOW())');
    $rqst->execute(array(
        'com'=>$_POST['commentaires'],
        'idPost'=>$_GET['idPost'],
        'pseudo'=>$_SESSION['pseudo']
 ));
}
?>
<style>
    textarea
    {
        height: 19px;
    }
</style>
<div class="page-content p-5 text-center" id="content">
    <a href="addPost.php">Ajouter un post</a> <br />
<?php
$rqstPost = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM post ORDER BY id DESC');
$rqstPost->execute();
while($post = $rqstPost->fetch())
{

echo '<h3>['.$post['dateHeure'].'] <span class="text-primary">'.$post['pseudo'].'</span> : '.$post['titre'].
    ' : <a href="../../crudUtilisateurs/upDel.php?idDelPost='.
    $post['id'].'"><img src="../../img/delete.png" alt="Suppression d\'un post"/></a> </h3><p>  <br />'.
    $post['message'].'</p>Commentaires : ';
?>
<p class="dropdown-divider"></p>
<?php
$rqstCom = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM commentairesPost WHERE idPost = ?');
$rqstCom->execute(array($post['id']));

    while($comPost = $rqstCom->fetch())
    {
        echo '<p><span class="text-primary">'.$comPost['pseudo'].'</span> [ '.$comPost['dateHeure'].' ] : <a href="../../crudUtilisateurs/upDel.php?idDelComPost='.
        $comPost['id'].'"><img src="../../img/delete.png" alt="Suppression d\'un message"/></a><br />'.
            $comPost['commentaires'].'</p>';
?>
<p class="dropdown-divider"></p>
<?php
    }
?>
<div style="border-bottom: solid black;">
<form method="post" action="<?php echo 'post.php?idPost='.$post['id'];?>">
    <label>Commentaires :
        <textarea name="commentaires"></textarea>
    </label>
    <input type="submit" name="sub" value="Envoyer" />
</form>
</div>
<?php
}
?>
</div>