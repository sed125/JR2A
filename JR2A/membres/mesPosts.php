<?php
session_start();
if($_SESSION['role'] == 'membre')
{
    include('utilsM.inc.php');
    start_page('Post');
    include('../connexion_Bdd/connexionBdd.php');
    // Repondre
    if($_POST['sub'] == 'Envoyer')
    {
        $rqst = $bdd->prepare('INSERT INTO `commentairesPost`(`commentaires`, `idPost`,`pseudo`, `dateHeure`) 
            VALUES (:com, :idPost, :pseudo, NOW())');
        $rqst->execute(array(
            'com'=>$_POST['commentaires'],
            'idPost'=>$_GET['idPost'],
            'pseudo'=>$_SESSION['pseudo']
        ));
    }
        // Supprimer un post
        if(isset($_GET['idDelPost']))
        {
            $rqstDel = $bdd->prepare('DELETE FROM `post` WHERE id = :id');
            $rqstDel->execute(array(
                'id'=>$_GET['idDelPost']
            ));
            $rqstDel->closeCursor();
        }
        // Supprimer une reponse
        if(isset($_GET['idDelRep']))
        {
            $rqstDel = $bdd->prepare('DELETE FROM `commentairesPost` WHERE id = :id');
            $rqstDel->execute(array(
                'id'=>$_GET['idDelRep']
            ));
            $rqstDel->closeCursor();
        }
    $rqstPost = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM post WHERE pseudo = ? ORDER BY id DESC');
    $rqstPost->execute(array($_SESSION['pseudo']));
    ?>
    <style>
        textarea
        {
            height: 19px;
        }
    </style>
    <center>
    <h3><a href="addPost.php" class="text-dark">- Ajouter du contenu -</a><h3>
    </center>
            <?php
            while($post = $rqstPost->fetch())
            {
            ?>
            <p class="dropdown-divider"></p>
            <div class="row text-center">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="border-bottom: solid black">
                <?php
                echo '<h2>['.$post['dateHeure'].'] <span class="text-primary">'.$post['pseudo'].'</span> '.
                    $post['titre'].' :</h2><p>'.
                    $post['message'].'</p> <br />';
                ?>
                <p class="dropdown-divider"></p>
                <?php
                $rqstCom = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM commentairesPost WHERE idPost = ?');
                $rqstCom->execute(array($post['id']));

                    while($comPost = $rqstCom->fetch())
                    {
                        echo '[ '.$comPost['dateHeure'].' ] <span class="text-primary">'.$comPost['pseudo'].'</span> : <a href="mesPosts.php?idDelRep='.
                        $comPost['id'].'"><img src="../img/delete.png" alt="Suppression post"/></a><br /> '.$comPost['commentaires'].'</p>';
                ?>
                <p class="dropdown-divider"></p>
                <?php
                    }
                ?>
                <form method="post" action="<?php echo 'mesPosts.php?idPost='.$post['id'];?>">
                    <label>Commentaires :
                        <textarea name="commentaires"></textarea>
                    </label>
                    <input type="submit" name="sub" value="Envoyer" />
                </form>
            </div>
            <div class="col-md-3">
                    <a href="<?php echo 'mesPosts.php?idDelPost='.$post['id'];?>">
                        <img src="../img/delete.png" alt="Suppression post"/>
                    </a>
            </div>
    </div>
    <?php
            }
            end_page();
}
else
{
    header('location: ../index.php');
}