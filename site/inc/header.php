<?php 
require "autoload.php";
$db = new DB();

session_start();

if(isset($_GET["deco"])){
	session_destroy();
	header("Location: .");
	exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Les joueurs qui ont marqué la coupe du monde de football</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--METATAGS POUR TWITTER-->
		<meta name="twitter:card" content="summary_large_image"/>
		<meta name="twitter:site" content="Les joueurs qui ont marqué l'Histoire de la coupe du monde"/>
		<meta name="twitter:title" content="Les joueurs qui ont marqué l'Histoire de la coupe du monde"/>
		<meta name="twitter:description" content="Les joueurs qui ont marqué l'Histoire de la coupe du monde"/>
		<meta name="twitter:creator" content="Mounir SENAOUI"/>
		<meta name="twitter:url" content="localhost"/>
		<meta name="twitter:image" content="images/slide1.png"/>
		<!--METATAGS OPENGRAPH-->
		<meta property="og:title" content="Les joueurs qui ont marqué l'Histoire de la coupe du monde"/>
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="localhost"/>
		<meta property="og:image" content="images/slide1.jpg"/>
		<meta property="og:description" content="Les joueurs qui ont marqué l'Histoire de la coupe du monde"/>
		<meta property="og:site_name" content="localhost"/>
		<link rel="shortcut icon" href="images/favicon.png">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>

	<body>
		<header class="w-100 fixed-top">
			<div class="container">
				<nav id="navbar" class=" navbar navbar-expand-lg navbar-light">
				  <a class="navbar-brand" href="."><img id="logo-cdm" src="images/logo-cdm" alt="logo coupe du monde"></a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				  </button>
				  
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      <li class="nav-item active">
				        <a class="nav-link text-light" href=".">Accueil<span class="sr-only">(current)</span></a>
				      </li>
				      
				      <li class="nav-item">
				        <a class="nav-link text-light" href="contact.php">Contact</a>
				      </li>
				      
				      <li class="nav-item">
				        <a href="admin.php" class="nav-link text-light">Admin</a>
				      </li>
				      
				      <li class="nav-item">
				      	<?php if(!isset($_SESSION["login"])){
				      	?>	
							<a class="nav-link text-light" href="admin.php">Connexion</a>
						<?php
						}
						else{
						?>	
							
							<a class="nav-link text-light" href="?deco">Se déconnecter</a>
				      	<?php
				      	}
				      	?>
						
				      </li>
				    </ul>
				  </div>
				</nav>
			</div>	
		</header>