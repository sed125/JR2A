<?php
session_start();
function start_page($title)
{
	session_start();
?>
<!doctype html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
			<title><?php echo $title; ?></title>
		</head>
		<body>
			<header>
        		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-3">
            		<a class="navbar-brand" href="index.php"><img src="img/logo_site.png" width=50 height=50></a>
            		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              			<span class="navbar-toggler-icon"></span>
            		</button>
          
            		<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<li class="nav-item dropdown active">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  				A propos de nous
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="documentation.php">Information</a>
					  				<a class="dropdown-item" href="contact.php">Contact</a>
					  				<div class="dropdown-divider"></div>
					  				<a class="dropdown-item" href="#">Nos reseaux</a>
								</div>
							</li>
              			<ul class="navbar-nav mr-auto">
                			<li class="nav-item active">
                  				<a class="nav-link" href="forum.php">Forum</a>
                			</li>
              			</ul>
              			<form class="form-inline my-2 my-lg-0">
                			<a class="btn btn-primary mr-md-2" href="connexion.php" role="button">Se connecter</a>
                			<a class="btn btn-primary mr-md-2" href="inscription.php" role="button">S'inscrire</a>
                			<input class="form-control mr-sm-2" type="search" placeholder="Rechercher...." aria-label="Search">
                			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
              			</form>
            		</div>
          		</nav>
    		</header>
<?php
}
function end_page()
{
?>
			<footer class="page-footer text-center bg-dark mt-5">
				<!-- Footer Links -->
				<div class="container">
		  			<!-- Grid row -->
		  			<div class="row">
						<!-- Grid column -->
						<div class="col-md-3 mx-auto">
			  				<!-- Links -->
			  				<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
			  				<ul class="list-unstyled">
								<li>
				  					<a href="#!">Very long link 1</a>
								</li>

			  				</ul>
						</div>
						<!-- Grid column -->
						
								<!-- Grid column -->
						<hr class="clearfix w-100 d-md-none">
						<!-- Grid column -->
						<div class="col-md-3 mx-auto">
							<!-- Links -->
							<h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
							<ul class="list-unstyled">
								<li>
									<a href="#!">Link 1</a>
								</li>
							</ul>
						</div>
						<!-- Grid column -->
		  			</div>
		  			<!-- Grid row -->
				</div>
				<!-- Footer Links -->
				<!-- Copyright -->
				<div class="footer-copyright text-center py-3">© 2020 Copyright: HSINO Amin
		  			<a href="contact.html"> Nous contacter</a>
				</div>
				<!-- Copyright -->
			</footer>
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>