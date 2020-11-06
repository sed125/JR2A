<?php
session_start();
if($_SESSION['role'] == 'membre')
{
    if($_POST['ajouter'] == 'Ajouter')
    {
        include('../connexion_Bdd/connexionBdd.php');
        $rqst = $bdd->prepare('INSERT INTO `post`(`titre`, `message`, `dateHeure`, `pseudo`) VALUES (:titre, :msg, NOW(), :pseudo)');
        $rqst->execute(array(
            'titre'=>$_POST['titre'],
            'msg'=>$_POST['msg'],
            'pseudo'=>$_SESSION['pseudo']
        ));
        $rqst->closeCursor();
        header('location: mesPosts.php');
    }
    include('utilsM.inc.php');
    start_page('Ajout d\'un post');
    ?>
        <style>
        textarea
        {
            height: 19px;
        }
    </style>
    <div class="row text-center">
        <div class="col-md-12">
            <form method="post" action="addPost.php">
                <label>Titre
                    <input type="text" name="titre" />
                </label> <br />
                <label>Message :
                    <textarea name="msg"></textarea>
                </label> <br />
                <input type="submit" name="ajouter" value="Ajouter" />
            </form>
        </div>
    </div>
<?php
}
else
{
    header('location: ../index.php');
}