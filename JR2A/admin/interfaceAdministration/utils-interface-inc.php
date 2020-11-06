<?php

function startPage($title)
{
session_start();
include('../../connexion_Bdd/connexionBdd.php');
$rqst = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
$rqst->execute(array($_SESSION['id']));
$infoUser = $rqst->fetch();
$rqst->closeCursor();
?>
<!doctype html>
<html lang="fr">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="css/interface.css">
<link rel="icon" type="image/png" href="../../img/favicon/favicon.ico">
<title><?php echo $title; ?></title>

</head>
<body>
<div class="vertical-nav bg-dark" id="">
    <div class="py-4 px-3  bg-dark">
      <div class="media d-flex align-items-center"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556074849/avatar-1_tcnd60.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h5 class="m-0"><?php echo $infoUser['prenom'] . ' ' . $infoUser['nom'] ?></h5>
          <p class="font-weight-light text-muted mb-0">Web developer</p>
        </div>
      </div>
    </div>
  
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">dashboard 
        <a class="ml-4" href="../../deconnexion.php">Déconnexion</a>
    </p>
  
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="post.php" class="nav-link text-dark font-italic bg-light">
                  <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                  Post
              </a>
      </li>
      <li class="nav-item">
        <a href="avis.php" class="nav-link text-dark font-italic bg-light">
            <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Avis
        </a>
      </li>
      <li class="nav-item">
            <a href="chat.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
               Chat   
            </a>
      </li>
    </ul>
  
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-2 mb-0">Forum</p>
  
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
            <a href="forum.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                Forum
            </a>
      </li>
      <!-- <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                New Forum
            </a>
      </li> -->
    </ul>

    <p class="text-gray font-weight-bold text-uppercase px-3 small py-2 mb-0">Support</p>

    <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="listUsers.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a href="aide.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Aide utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a href="parametreDuCompte.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Paramètres
            </a>
        </li>
        <li class="nav-item">
            <a href="../../deconnexion.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Deconnexion
            </a>
        </li>
      </ul>
  </div>
  <!-- End vertical navbar -->
<?php
}
function endPage()
{
?>  
</body>
</html>
<?php 
}


  