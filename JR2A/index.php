<?php 
    include('utils-inc.php');
	start_page('JR2A');
	
?>
			<main class="container-fluid mt-5 mb-5">
			
				<article>
					
					<div class="row text-center">
					
						<!-- <div class="col-md-4">
							
						</div> -->
						<div class="col-md-8">
							<div style="border: solid black;">
								<p class="dropdown-divider"></p>
								<?php
								include('connexion_Bdd/connexionBdd.php');
								$rqstPost = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM post ORDER BY id DESC');
								$rqstPost->execute();
								while($post = $rqstPost->fetch())
								{

								echo '<span class="text-primary">'.
									$post['pseudo'].'</span><h4>['.$post['dateHeure'].'] '.$post['titre'].' :</h4><p><br />'.
									$post['message'].'</p><strong>Commentaires :</strong>';
								?>
								<p class="dropdown-divider"></p>
								<?php
								$rqstCom = $bdd->prepare('SELECT *, DATE_FORMAT(dateHeure, "%d/%m/%Y / %Hh%imin") dateHeure FROM commentairesPost WHERE idPost = ?');
								$rqstCom->execute(array($post['id']));

									while($comPost = $rqstCom->fetch())
									{
										echo '<p><span class="text-primary">'.$comPost['pseudo'].' </span>'.$comPost['dateHeure'].' : <br />'.$comPost['commentaires'].'</p>';
								?>
								<p class="dropdown-divider"></p>
								<?php
									}
								}
								$rqstPost->closeCursor();
								?>
							</div>
						</div>
						<div class="col-md-4" >
							<h3>Avis :</h3>
							<ul style="list-style-type: none;">
								<?php
								$rqst = $bdd->prepare('SELECT * FROM avis ORDER BY id DESC');
								$rqst->execute();
								while($avis = $rqst->fetch())
								{
								?>
									<li style="border:solid black; border-radius: 10px;" class="mb-2">
										<?php 
										echo '<span class="text-primary">'.$avis['pseudo'].'</span> ['.$avis['dateHeure'].'] :<br />'.$avis['avis'];	
										?>
									</li>

								<?php
								}
								$rqst->closeCursor();
								?>
							</ul>
						</div>
					</div>
				</article>
			</main>
<?php
	end_page();
?>