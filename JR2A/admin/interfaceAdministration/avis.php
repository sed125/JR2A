<?php
include('utils-interface-inc.php');
startPage('Avis');
include('../../connexion_Bdd/connexionBdd.php');
?>
<div class="page-content p-5 text-center" id="content">
    <?php
    $rqst = $bdd->prepare('SELECT * FROM avis ORDER BY id DESC');
    $rqst->execute();
    while($avis = $rqst->fetch())
    {
    ?>
        <p>
            <?php
            echo '<span class="text-primary">'.$avis['pseudo'].'</span> ['.
                $avis['dateHeure'].'] <a href="../../crudUtilisateurs/upDel.php?idAvis='.
                $avis['id'].'"><img src="../../img/delete.png" /></a> <br />'.
                $avis['avis'];	
            ?>
        </p>
        <p class="dropdown-divider"></p>
    <?php
    }
    ?>
</div>
