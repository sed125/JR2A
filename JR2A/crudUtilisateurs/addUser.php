<?php
session_start();
if($_SESSION['role'] == 'admin')
{
?>


<form method="post" action="upDel.php">
						<label>Entrez votre prénom :
						    <input type="text" name="prenom" placeholder="Prénom" autocomplete="off" >
			
		                </label><br />
						<label>Entrez votre nom :
					
			
						    <input type="text" name="nom" placeholder="Nom" autocomplete="off" >
					
			            </label> <br />
		
						<label>Téléphone
			
				
						    <input type="text" name="tel" placeholder="Numéro" autocomplete="off" required><br>
				
				        </label> <br />
				
						<label>E-Mail
					
						<input type="text" name="email" placeholder="Email" autocomplete="off" ><br>
					    </label> <br />
				
						<label>Entrez votre mot de passe :
					
						<input type="password" name="password" required placeholder="Mot de passe" autocomplete="off"><br>
					    </label> <br />
				
						<label>Confirmez votre mot de passe :
					
						<input type="password" required name="confirmPassw" placeholder="Mot de passe" autocomplete="off"><br>
					
						</label> <br />
										
						<label>Role :
							<select name="role">
								<option value="admin">Admin</option>
								<option value="membre">Membre</option>
							<select>
						</label> <br />

			
						<input type="submit" name="add" value="Ajouter">
			
			
						<input type="reset" name="effacer" value="Effacer">
				

			</form>
<?php
}

else
{
	header('location: ../index.php');
}