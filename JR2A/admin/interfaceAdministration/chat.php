<?php
include('utils-interface-inc.php');
startPage('Chat');
?>
<div class="page-content p-5 text-center" id="content">
                    <h1>
                        <a href="interface.php">
                            <img src="../../img/refresh.png">
                        </a>Chat :
                    </h1>
                    <?php
                    include('../../connexion_Bdd/connexionBdd.php');
                    $rqst = $bdd->prepare('SELECT id, pseudo, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") AS dateHeure, message FROM chat');
                    $rqst->execute();                          
                    while($infoMsg = $rqst->fetch())
                    {
                    ?>
                    <p>
                        <?php 
                            echo '(' .$infoMsg['dateHeure'] . ') [ADMIN] ' . '<span style="color:blue;">' . 
                                $infoMsg['pseudo'] . '</span> : ' . $infoMsg['message'];
                        ?>
                        <a href="<?php echo '../../crudUtilisateurs/upDel.php?idDelMsg='.$infoMsg['id']; ?>">
                            <img src="../../img/delete.png" alt="Suppression d'un utilisateur" />
                        </a>                            
                    </p>
                    <?php
                    }
                    ?>   
                    <form method="post" action="../../chat/chat.php">
                        <input type="text" name="message" />
                        <input type="submit" value="Envoyer" />
                    </form>
</div>