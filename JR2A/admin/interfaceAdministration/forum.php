<?php 
include('utils-interface-inc.php');
include('../../connexion_Bdd/connexionBdd.php');
startPage('Forum');

?>
<style>
    textarea
    {
        height: 19px;
    }
</style>
    <main class="container-fluid">
        <div class="page-content p-5 text-center" id="content">
            <div class="row text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4 pb-2 pt-2" style="border:solid black;">

                            Poster du contenu sur le forum
                        <form method="post" action="modForum.php">
                            <label> Question : 
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
        </div>
    <div class="page-content p-5 text-center" id="content">
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
                                                $reponse['dateHeure'].']</em> : <a href="modForum.php?idDelRep='.
                                                $reponse['id'].'"><img src="../../img/delete.png" /></a><br />'.
                                                $reponse['reponse'];
                                                ?>
                                            
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-md-2"></div>  
                                    <?php
                                    }
                                    ?>
                            
                            <form method="post" action="<?php echo 'modForum.php?idQuest='.$questionDetails['id'];?>">
                                <textarea name="reponse"></textarea>
                                <input type="submit" name="repondre" value="Répondre" />
                            </form>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo 'modForum.php?idDelQuest='.$questionDetails['id'];?>">
                            <img src="../../img/delete.png" />
                        </a>
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



?>