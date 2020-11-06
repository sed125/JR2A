<?php
include('utils-interface-inc.php');
startPage('Aide');
include('../../connexion_Bdd/connexionBdd.php');
?>
<center>
<div class="page-content p-5 text-center" id="content">
<?php
$rqst = $bdd->prepare('SELECT id, prenom, nom, email, message, DATE_FORMAT(dateMsg, "%d/%m/%Y / %Hh%imin") dateH 
                        FROM aide ORDER BY id DESC');
$rqst->execute();

while($formHelp = $rqst->fetch())
{  
    echo '<h2 class="text-center">( '.$formHelp['dateH'].' ) <a href="../../crudUtilisateurs/upDel.php?idDelMsgAide='.
    $formHelp['id']. '"><img src="../../img/delete.png" alt="Suppression d\'un utilisateur" /> </a></h2><p class="text-center">Nom : '.
    $formHelp['prenom'].' '.
    $formHelp['nom'].'<br /> Email : '.
    $formHelp['email'].'  '.'<br /> Question : <br />'.
    $formHelp['message']. '<br />';
?>
<p class="dropdown-divider"></p>
<?php
    $rqstReponse = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure
                    FROM reponseAide 
                    WHERE idQuestion = ?');
    $rqstReponse->execute(array($formHelp['id']));
    while($rep = $rqstReponse->fetch())
    {
        echo ' [ ADMIN ] : '.$rep['reponse']. ' || <em> ['.$rep['dateHeure']  .']</em> || <br />';
?>
<p class="dropdown-divider"></p>
<?php
    }
      

?>  
        <form method="post" action="<?php echo 'aideReponse.php?idRep='.$formHelp['id']?>" class="text-center">
            <label> Reponse :
                <input type="text" name="reponse"/>
            </label>
            <input type="submit" name="repondre" value="Repondre" />
        </form>
        <p class="dropdown-divider"></p>
        
</div>
</center>
<?php

}
$rqst->closeCursor();
$rqstReponse->closeCursor();

