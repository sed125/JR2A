<?php
session_start();
if($_SESSION['role'] === 'admin')
{
	include('admin/utilsA.inc.php');
	start_page('Paramètre du compte');

}
elseif($_SESSION['role'] === 'membre')
{
	include('membres/utilsM.inc.php');
	start_page('Paramètre du compte');

}

$id = $_SESSION['id'];
include('connexion_Bdd/connexionBdd.php');
$getInfos = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
$getInfos->execute(array(
        'id' => $id
));
    $listInfos = $getInfos->fetch();

?>
<form method="post" action="crudUtilisateurs/upDel.php">
<label>Entrez votre prénom :
						    <input type="text" name="prenom" placeholder="<?php echo $listInfos['prenom'] ?>" autocomplete="off" ><br>
			
		                </label> <br />
						<label>Entrez votre nom :
					
			
						    <input type="text" name="nom" placeholder="<?php echo $listInfos['nom'] ?>" autocomplete="off" ><br>
					
			            </label> <br />
		
						<label>Téléphone
			
				
						    <input type="text" name="tel" placeholder="<?php echo $listInfos['telephone'] ?>" autocomplete="off" required><br>
				
				        </label> <br />
				
						<label>E-Mail
					
						<input type="text" name="email" placeholder="<?php echo $listInfos['email'] ?>" autocomplete="off" ><br>
					    </label> <br />
                        <label>Entrez votre ancien mot de passe :

                            <input type="password" name="ancienPassword" required placeholder="Mot de passe" autocomplete="off">
                        </label> <br />
						<label>Entrez votre nouveau mot de passe :
					
						<input type="password" name="password" required placeholder="Mot de passe" autocomplete="off"><br>
					    </label> <br />
				
						<label>Confirmez votre nouveau mot de passe :
					
						<input type="password" required name="confirmPassw" placeholder="Mot de passe" autocomplete="off"><br>
					
						</label> <br />
<?php 
if($_SESSION['role'] == "admin")
{
?>
						<label>Role :
							<select name="role">
								<option value="admin">Admin</option>
								<option value="membre">Membre</option>
							<select>
                        </label> <br />
<?php
}
?>			
						<input type="submit" name="update" value="Modifier les paramètres de mon compte">
						
						<input type="reset" name="effacer" value="Effacer">
</form>
<?php
include('utils.inc.php');
    end_page();
    