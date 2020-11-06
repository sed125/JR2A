<?php 
session_start();


if(isset($_GET['idUpdate']))
{
    include('../connexion_Bdd/connexionBdd.php');
    $getInfos = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
    $getInfos->execute(array(
            'id' => $_GET['idUpdate']
    ));
    $listInfos = $getInfos->fetch(); 
    $_SESSION['idUpdate'] = $_GET['idUpdate'];
}
?>
<form method="post" action="upDel.php">

						<label>Prénom :
						    <input type="text" name="prenom" value="<?php echo $listInfos['prenom'] ?>" autocomplete="off" ><br>
			
                        </label>
                     
						<label>Nom :
					
			
						    <input type="text" name="nom" value="<?php echo $listInfos['nom'] ?>" autocomplete="off" ><br>
					
                        </label>

		
						<label>Téléphone :
			
				
						    <input type="text" name="tel" value="<?php echo $listInfos['telephone'] ?>" autocomplete="off"><br>
				
                        
                        </label>

						<label>E-Mail :
					
						<input type="text" name="email" value="<?php echo $listInfos['email'] ?>" autocomplete="off" ><br>
                        </label>

                        <label>Pseudo :
					
						<input type="text" name="pseudo" value="<?php echo $listInfos['pseudo'] ?>" autocomplete="off" ><br>
                        </label>
			
			
						<label>Mot de passe :


						<input type="password" name="password" required placeholder="Mot de passe" autocomplete="off"><br>
                        </label>
				
						<label>Confirmez le nouveau mot de passe :
					
						<input type="password" required name="confirmPassw" placeholder="Mot de passe" autocomplete="off"><br>
					
                        </label>

                        <label>
                            Role :
                            <select name="role"> 
                                <option value="admin"> Admin </option>
                                <option value="membre"> Membre </option>
                            </select>
                        </label>
		
						
                            <input type="submit" name="update" value="Modifier">
                        

			
						<input type="reset" name="effacer" value="Effacer">
                        
				

            </form>