<?php 
require "inc/header.php";
if(!isset($_SESSION["login"])){
	header("Location: admin.php");
	exit;
}

if(isset($_GET["id"])){
	$id = (int) $_GET["id"];

	if($db->exists($id)){
		$visitor = $db->get($id);
		$lastname = $visitor->lastName();
		$firstname = $visitor->firstName();
		$email = $visitor->email();
		$message = $visitor->message();
		$date = new DateTime($visitor->dateSendMessage());
		$dateFr = $date->format("d/m/Y à H:i");

	}
	else{
		$error = "<div class='alert alert-danger text-center' role='alert'>Ce formulaire n'existe pas ! <a href='admin'>Retour à l'admin</a></div>";
	}
}
else{
	$error = "<div class='alert alert-danger text-center' role='alert'>Aucun formulaire à afficher ! <a href='admin'>Retour à l'admin</a></div>";
}
?>
<div class="container margin-t-100">
<?php if(isset($firstname)){
?>
	<h1 class="text-center">Contenu du formulaire</h1>
	<p><a href="admin.php">Retour à la liste des formulaires</a></p>
		<div class="visitor">
			<p><?= "<strong>" .$firstname. " " .$lastname. "</strong> " .$email ?><em> le <?= $dateFr ?></em></p>
			<p>Message reçu :<br>
				<?= nl2br($message) ?>
			</p>
		</div>
<?php	
}else{
	echo $error;
}
?>
	
</div>

<?php 
require "inc/footer.php";
?>