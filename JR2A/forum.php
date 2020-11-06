<?php 
include('utils-inc.php');
start_page('Forum');
include('connexion_Bdd/connexionBdd.php');
?>
<style> 
    .textarea textarea
    {
        width: 46%;
        height: 18px;
    }
</style>
    <main class="container-fluid mt-2">
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
                                                $reponse['dateHeure'].']</em> :<br />'.
                                                $reponse['reponse'];
                                                ?>
                                            
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-md-2"></div>  
                                    <?php
                                    }
                                    ?>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                
                <!-- <div style="border:solid black;"></div> -->
        <?php
            }
            $rqstQuestion->closeCursor();
            
        ?> 
   
                
    </main>

<?php 
end_page();
?>