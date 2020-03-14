<?php 
if(isset($_POST["submit"])){
	$login = $_POST["login"];
	$password = $_POST["password"];

	if(!empty($login) && !empty($password)){
		$db = new DB();

		if($db->userExists($login)){
			$user = $db->getUser($login);

			if(password_verify($password, $user->password)){
				$_SESSION["login"] = $login;
				header("Location: admin.php");
				exit;
			}
		}else{
			$alert = "<div class='alert alert-danger text-center' role='alert'>Votre login ou votre mot de passe est incorrecte</div>";
		}		
	}else{
		$alert = "<div class='alert alert-danger text-center' role='alert'>Votre login ou votre mot de passe est incorrecte</div>";
	}
}	
?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6 mx-auto">
			<h1 class="text-center margin-t-100">Connexion</h1>
			<?php if(isset($alert)){echo $alert;}?>	
			<form action="" method="POST" class="mb-5">
				<div class="form-group">
					<label for="login">Login :</label>
					<input type="text" class="form-control" name="login" id="login">
				</div>
				<div class="form-group">
					<label for="password">Mot de passe :</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				
				<button type="submit" name="submit" class="btn btn-dark">Connexion</button>
			</form>
		</div>
	</div>
</div>