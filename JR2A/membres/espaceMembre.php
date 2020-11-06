<?php
session_start();
if($_SESSION['role'] == 'membre')
{
    include('utilsM.inc.php');
    start_page('JR2A');
    include('../connexion_Bdd/connexionBdd.php');
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
    if($_POST['submit'] == 'ajouter')
    {
        $rqst = $bdd->prepare('INSERT INTO `avis`(`pseudo`, `avis`, `dateHeure`) 
            VALUES (:pseudo, :avis, NOW())');
        $rqst->execute(array(
            'pseudo'=>$_SESSION['pseudo'],
            'avis'=>$_POST['avis']
        ));
    }
?>
<style>
textarea
{
    height: 19px;
}
</style>
    <main class="mt-5">
        <div class="container-fluid">
                
            <div class="row text-center">
                            <div class="col-md-4">
                                Bonjour  
                                <?php 
                                echo $_SESSION['prenom'];
                                ?>
                                !<br />
                            </div>
                            <div class="col-md-4">
                    <?php
						$rqstPost = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM post ORDER BY id DESC');
						$rqstPost->execute();
						while($post = $rqstPost->fetch())
						{
                        ?>
                            <div class="row">
                                
                                <div class="col-md-12 mb-4" style="border: solid black;">
                                    <?php
                                        echo '<h4>'.$post['titre'].' ['.
                                        $post['dateHeure'].']<br /> </h4><p>'.
                                        $post['message'].'</p><br /><div class="text-right"><span class="text-primary ml-5 text-right">'.
                                        $post['pseudo'].'</span></div><br />';
                                        
                                    ?>
                                    
                                    <?php
                                    $rqstCom = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM commentairesPost WHERE idPost = ?');
                                    $rqstCom->execute(array($post['id']));
                                    ?>
                                    
                                        <?php
                                            while($comPost = $rqstCom->fetch())
                                            {
                                        ?>
                                                <div style="border: solid black; border-radius: 5px;">
                                        <?php
                                                echo    $comPost['dateHeure'].' : <br />'.
                                                    $comPost['commentaires'];
                                        ?>
                                        </div>
                                        <p class="dropdown-divider"></p>
                                        <?php
                                            }
                                            ?>
                                            <p class="dropdown-divider"></p>
                                  <form method="post" action="<?php echo 'espaceMembre.php?idPost='.$post['id'];?>">
                                    Commentaires :
                                        <textarea name="commentaires"></textarea>
                                    
                                    <input type="submit" name="sub" value="Envoyer" />
                                </form>
                                    </div> 
                            </div>
                        <?php
                                
                        }
                        $rqstPost->closeCursor();
                        
                        ?>
                            <p class="dropdown-divider"></p>
                    </div>
                
                <div class="col-md-4">
                    
                    
                            <form method="post" action="espaceMembre.php">
                                <label>Ajouter un avis sur le site et les administrateurs :
                                    <input type="text" name="avis" />
                                </label>
                                <input type="submit" name="submit" value="ajouter" />
                            </form>
                        <br />
                        <div class="" style="border:solid black;">
                        <h1><a href="espaceMembre.php"><img src="../img/refresh.png"></a>Chat :</h1> 
                        
                        <?php 
                        $rqst = $bdd->prepare('SELECT pseudo, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") AS dateHeure, message FROM chat');
                        $rqst->execute();                          
                        while($infoMsg = $rqst->fetch())
                        {
                        ?>
                        <p class="mb-2 pb-2 pl-2 pr-2 pt-2">
                            <span class="" style="border: solid black;">
                                <?php 
                                echo '(' .$infoMsg['dateHeure'] . ') <span class="text-primary">' . 
                                    $infoMsg['pseudo'] . '</span> : ' . $infoMsg['message'];                                    
                                ?>
                            </span>
                        </p>
                        <?php
                        }
                        ?>
                        <form method="post" action="espaceMembre.php">

                        </form>
                        <?php
                        $rqst->closeCursor();
                        ?>   
                        <form method="post" action="../chat/chat.php">
                            <input type="text" name="message" />
                            <input type="submit" value="Envoyer" />
                        </form>
                    </div>
                </div>
            </div>
    </main>
<?php
    end_page();
}
else
{
    header('location: ../index.php');
}
?>