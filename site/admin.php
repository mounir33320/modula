<?php
require "inc/header.php";
?>
<?php 
//Formulaire de connexion
if(!isset($_SESSION["login"])){
	require "inc/connection.php";
}//Fin du formulaire
else{
	if(isset($_GET["delete"])){
		$delete = (int) $_GET["delete"];
		if($db->exists($delete)){
			$user = $db->get($delete);
			$db->delete($user);
			$message = "<div class='alert alert-success text-center' role='alert'>Le formulaire a été supprimé avec succès</div>";
		}
		else{
			$message = "<div class='alert alert-danger text-center' role='alert'>Ce formulaire n'existe pas</div>";
		}
	}

	$list = $db->getList();
?>
<div class="container bloc-admin">
	<?php if(isset($message)){echo $message;}?>
	<table class="table table-striped table-dark">
		<thead>
			<tr>
				<th scope="col">Date et heure</th>
				<th scope="col">Email</th>
				<th scope="col"></th>
			</tr>
		</thead>
		
		<tbody>
<?php
foreach($list as $value){
	$date = new DateTime($value->dateSendMessage());
	$dateFr = $date->format("d/m/Y à H:i");
?>
			<tr>
				<td><?= $dateFr?></td>
				<td><?= $value->email()?></td>
				<td><a href="form?id=<?= $value->id() ?>" class="btn btn-primary">Voir</button></td>
				<td><a href="?delete=<?= $value->id() ?>" class="btn btn-danger">Supprimer</button></td>
			</tr>
<?php
}
?>
			
		</tbody>
	</table>
</div>
<?php 
}
require "inc/footer.php";
?>