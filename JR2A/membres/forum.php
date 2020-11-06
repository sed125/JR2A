<?php
session_start();
if($_SESSION['role'] == 'membre')
{
    include('utilsM.inc.php');
    start_page('Forum');
    include('../connexion_Bdd/connexionBdd.php');
    if($_POST['add'] == 'Envoyer')
    {
        $rqst = $bdd->prepare('INSERT INTO `forum` (`user`, `question`, `details`, `dateHeure`) VALUES (:pseudo, :question, :details, NOW())');
        $rqst->execute(array(
            'pseudo'=>$_SESSION['pseudo'],
            'question'=>$_POST['question'],
            'details'=>$_POST['details']
        ));
        $rqst->closeCursor();
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
    }
    // Supprimer une question
    if(isset($_GET['idDelQuest']))
    {
        $rqstDel = $bdd->prepare('DELETE FROM `forum` WHERE id = :id');
        $rqstDel->execute(array(
            'id'=>$_GET['idDelQuest']
        ));
        $rqstDel->closeCursor();
    }
    // Supprimer une reponse
    if(isset($_GET['idDelRep']))
    {
        $rqstDel = $bdd->prepare('DELETE FROM `reponseForum` WHERE id = :id');
        $rqstDel->execute(array(
            'id'=>$_GET['idDelRep']
        ));
        $rqstDel->closeCursor();
    }
?>
<style>
    textarea
    {
        height: 19px;
    }
</style>
    <main class="container-fluid mb-2">
            <div class="row text-center mt-2 mb-2">
                <div class="col-md-4"></div>
                <div class="col-md-4 pb-2 pt-2" style="border:solid black;">

                            Poster du contenu sur le forum
                        <form method="post" action="forum.php">
                            <label> Titre / Question : 
                                <input type="text" name="question" /> 
                            </label> <br />
                            Détail : 
                                <textarea name="details"></textarea>
                            <input type="submit"  name="add" value="Envoyer"/>
                        </form>
    
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        <?php
        $rqstQuestion = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM forum ORDER BY id DESC');
        $rqstQuestion->execute();
        while($questionDetails = $rqstQuestion->fetch())
        {   
        ?>
                <div class="row text-center mb-5">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8" style="border: solid black;">
                    
                        <?php
                        $rqstRep = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM reponseForum WHERE idQuestion = ?');
                        $rqstRep->execute(array($questionDetails['id'])); 
                        
                            echo '"'.$questionDetails['question'].'"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>[ '.
                            $questionDetails['dateHeure'].' ]</em> : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-primary">'.
                            $questionDetails['user'].'</span><br />'.
                            $questionDetails['details'].'<br />';
                        ?>  
                        <p class="dropdown-divider"></p>  
                            
                                
                                    <?php
                                    while($reponse = $rqstRep->fetch())
                                    {
                                    ?>
                                    <div class="row text-center">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8"> 
                                            <div style="border: solid black;border-radius: 5px;" class="mb-2">
                                                <?php
                                                echo '<span class="text-primary">'.$reponse['user'].'</span> <em>['.
                                                $reponse['dateHeure'].']</em>'.
                                                $reponse['reponse'];
                                        if($reponse['user'] == $_SESSION['pseudo'])
                                        {
                                        ?>
                                            <a href="<?php echo 'forum.php?idDelRep='.$reponse['id']; ?>">
                                                <img src="../img/delete.png" alt="Suppression commentaires"/>
                                            </a>
                                        <?php
                                        }
                        ?>
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-md-2"></div>  
                                    <?php
                                    }
                                    ?>
                            
                            <form method="post" action="<?php echo 'forum.php?idQuest='.$questionDetails['id'];?>">
                                <textarea name="reponse"></textarea>
                                <input type="submit" name="repondre" value="Répondre" />
                            </form>
                    </div>
                    <div class="col-md-2">
                        <?php
                        if($questionDetails['user'] == $_SESSION['pseudo'])
                        {
                        ?>
                            <a href="<?php echo 'forum.php?idDelQuest='.$questionDetails['id']; ?>">
                                <img src="../img/delete.png" alt="Suppression post"/>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                
                <!-- <div style="border:solid black;"></div> -->
        <?php
            }
            $rqstQuestion->closeCursor();
            
        ?> 
       </div>     
    </main>

<?php
end_page();
}