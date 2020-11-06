<?php
session_start();
function start_page($title)
{
?>
<!doctype html>
<html lang="fr">
	<head>
		 <!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" href="../img/logo_site.png" />
		<title><?php $title ?></title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
		crossorigin="anonymous">			
	<!--	<link rel="stylesheet" href="css/main.css"> -->
			<!-- <link rel="stylesheet" href="../css/de.css" /> -->

	</head>
	<body>
		<header class="mb-2" id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <!-- Image barre de nav-->
                <a class="navbar-brand" href="index.php"><img src="../img/logo_site.png" width=44 height=44 id="logo" alt="Logo" ></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                    <ul class="navbar-nav mr-auto ml-auto" >				
                        <li class="nav-item">
                            <a class="nav-link" href="../help.php" tabindex="-1">Aide et Contact</a>
                        </li>
                        <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" 
								role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Mon compte
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../parametreDuCompte.php">Paramètres du compte</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../deconnexion.php">Déconnexion</a>
                            </div>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" href="../forum.php">Forum</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">				
                    <a href=""><img src="../img/zoom.png" alt="zoom" class="btn my-2 my-sm-0" id="loupe" width=55 height=38></a>
                    </form>
                </div>
            </nav>
		</header>
<?php 
}
function end_page()
{
        ?>
                    <footer class="page-footer text-center">
                        Copyright Hsino Amin, Tous droits réservés<br>
                        <a href="../contact.html">Nous Contacter</a>
                    </footer>
                </div>
                    <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
                        crossorigin="anonymous">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
                    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
                        crossorigin="anonymous">
                </script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
                    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
                        crossorigin="anonymous">
                </script>
            </body>
        </html>
        <?php 
}
?>