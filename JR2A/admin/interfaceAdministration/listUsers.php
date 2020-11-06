<?php
    include('utils-interface-inc.php');
    startPage('Listes des utilisateurs');
    include('../../connexion_Bdd/connexionBdd.php');
    $reqtAdmin = $bdd->prepare("SELECT * FROM membres WHERE role = 'admin'");
    $reqtAdmin->execute();
    $reqtMembres = $bdd->prepare('SELECT * FROM membres WHERE role = "membre"');
    $reqtMembres->execute();
?>  
<div class="page-content p-5" id="content">
    <h1 class="text-center text-black font-weight-bold text-uppercase px-3 medium pb-4 mb-0">Admin :</h1>
    <div class="row text-center">
        <div class="col-md">               
            <table class="table table-dark">
                <tr>
                    <th>id :</th>
                    <th>Email :</th>
                    <th>Prénom :</th>
                    <th>Nom :</th>
                    <th>Téléphone :</th>
                    <th>Role :</th>
                    <th>Date d'inscription :</th>
                    <th>
                        <a href="../../crudUtilisateurs/addUser.php">
                            <img src="../../img/add.png" alt="Ajout d'un utilisateur" />
                        </a>
                    </th>
                </tr>  
<?php               
    while($listAdmin = $reqtAdmin->fetch())
    {
?>
                        <tr>
                            <td><?php echo $listAdmin['id'] ?></td>
                            <td><?php echo $listAdmin['email'] ?></td>
                            <td><?php echo $listAdmin['prenom'] ?></td>
                            <td><?php echo $listAdmin['nom'] ?></td>
                            <td><?php echo $listAdmin['telephone'] ?></td>
                            <td><?php echo $listAdmin['role'] ?></td>
                            <td><?php echo $listAdmin['date_Inscription'] ?></td>
                            <td>
                                <a href="<?php echo '../../crudUtilisateurs/formUpdate.php?idUpdate='.$listAdmin['id']; ?>">
                                    <img src="../../img/pencil.png" alt="Modifier les informations d'un utilisateur" />
                                </a>  
                            </td> 
                            <td>
                                <a href="<?php echo '../../crudUtilisateurs/upDel.php?idDelAdmin='.$listAdmin['id']; ?>">
                                    <img src="../../img/delete-user.png" alt="Suppresion d'un utilisateur" />
                                </a>
                            </td>                            
                        </tr>
<?php
    }
?>
                    </table>
</div>
</div>
                

        
            <h1 class="text-center text-black font-weight-bold text-uppercase px-3 medium pb-4 mb-0">Membres :</h1>
            <div class="row text-center">  
            <div class="col-md">    
                        <table class="table table-dark">
                            <tr>
                                <th>id :</th>
                                <th>Email :</th>
                                <th>Prénom :</th>
                                <th>Nom :</th>
                                <th>Téléphone : </th>
                                <th>Role :</th>
                                <th>Date d'incription : </th>
                                <th>
                                    <a href="../../crudUtilisateurs/addUser.php">
                                        <img src="../../img/add.png" alt="Ajout d'un utilisateur" />
                                    </a>
                                </th>
                            </tr>        
<?php
    while($listMembres = $reqtMembres->fetch())
    {
?>
                            <tr>
                                <td><?php echo $listMembres['id'] ?></td>
                                <td><?php echo $listMembres['email'] ?></td>
                                <td><?php echo $listMembres['prenom'] ?></td>
                                <td><?php echo $listMembres['nom'] ?></td>
                                <td><?php echo $listMembres['telephone'] ?></td>
                                <td><?php echo $listMembres['role'] ?></td>
                                <td><?php echo $listMembres['date_Inscription'] ?></td>
                                <td>
                                    <a href="<?php echo '../../crudUtilisateurs/formUpdate.php?idUpdate='.$listMembres['id']; ?>">
                                        <img src="../../img/pencil.png" alt="Modifier les informations d'un utilisateur" />
                                    </a>    
                                </td> 
                                <td>     
                                    <a href="<?php echo '../../crudUtilisateurs/upDel.php?idDelAdmin='.$listMembres['id']; ?>">
                                        <img src="../../img/delete-user.png" alt="Suppresion d'un utilisateur" />
                                    </a>
                                </td>
                            </tr>
<?php
    }
?>
                        </table>
                  
                </div>
</div>
</div>
<?php          
   $reqtAdmin->closeCursor();
   $reqtMembres->closeCursor();
   endPage();
?>