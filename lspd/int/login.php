<?php
ini_set('session.gc_maxlifetime', 3600*24);
session_set_cookie_params(3600*24);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config.php');

if (isset($_COOKIE["userconnect"]) && isset($_COOKIE["mdpconnect"])){
	$requser = $bdd->prepare("SELECT * FROM members_lspd WHERE username = ? AND password = ?");
	$requser->execute(array($_COOKIE["userconnect"], $_COOKIE["mdpconnect"]));
	$userexist = $requser->rowCount();
	if ($userexist == 1) {
		setcookie("userconnect", $_COOKIE["userconnect"], time() + 24*3600);
		setcookie("mdpconnect", $_COOKIE["mdpconnect"], time() + 24*3600);
		setcookie("id", $_COOKIE["id"], time() + 24*3600);
		setcookie("grade", $_COOKIE["grade"], time() + 24*3600);
		setcookie("name", $_COOKIE["name"], time() + 24*3600);
		setcookie("firstname", $_COOKIE["firstname"], time() + 24*3600);
		setcookie("division", $_COOKIE["division"], time() + 24*3600);
		setcookie("matricule", $_COOKIE["matricule"], time() + 24*3600);
		header("Location: index.php");
	}
}

if (isset($_POST['formconnexion'])) {
	$userconnect = htmlspecialchars($_POST['userconnect']);
	$mdpconnect = hash('sha256', $_POST['mdpconnect']);
	if (!empty($userconnect) and !empty($mdpconnect)) {
	  $requser = $bdd->prepare("SELECT * FROM members_lspd WHERE username = ? AND password = ?");
	  $requser->execute(array($userconnect, $mdpconnect));
	  $userexist = $requser->rowCount();
	  if ($userexist == 1) {
		$userinfo = $requser->fetch();
		if ($_POST["remember"] == "on"){
			setcookie("userconnect", $userconnect, time() + 30*24*3600);
			setcookie("mdpconnect", $mdpconnect, time() + 30*24*3600);
			setcookie("id", $userinfo['ID'], time() + 30*24*3600);
			setcookie("grade", $userinfo['grade'], time() + 30*24*3600);
			setcookie("name", $userinfo['name'], time() + 30*24*3600);
			setcookie("firstname", $userinfo['firstname'], time() + 30*24*3600);
			setcookie("division1", $userinfo['division1'], time() + 30*24*3600);
			setcookie("division2", $userinfo['division2'], time() + 30*24*3600);
			setcookie("matricule", $userinfo['matricule'], time() + 30*24*3600);


		}else {
			setcookie("userconnect", $userconnect, time() + 24*3600);
			setcookie("mdpconnect", $mdpconnect, time() + 24*600);
			setcookie("id", $userinfo['ID'], time() + 24*3600);
			setcookie("grade", $userinfo['grade'], time() + 24*3600);
			setcookie("name", $userinfo['name'], time() + 24*3600);
			setcookie("firstname", $userinfo['firstname'], time() + 24*3600);
			setcookie("division1", $userinfo['division1'], time() + 24*3600);
			setcookie("division2", $userinfo['division2'], time() + 24*3600);
			setcookie("matricule", $userinfo['matricule'], time() + 24*3600);
		}
		
		header("Location: index.php");
	  } else {
		$erreur = "Utilisateur ou mot de passe invalide !";
	  }
	} else {
	  $erreur = "Tous les champs doivent être remplis !";
	}
  }

?>

<!doctype html>
<html lang="fr">
  <head>
  	<title>Connexion - LSPD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="favicon" href="/assets/favicon.ico">

	</head>
	<body>
	<?php include ('functions/matomo.php');?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(assets/banniere_lspd.png);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Connexion</h3>
			      		</div>
			      	</div>
					<form method="POST" class="signin-form">
			      		<div class="form-group mt-3">
			      			<input type="text" class="form-control" name="userconnect" required autofocus>
			      			<label class="form-control-placeholder" for="username">Nom d'utilisateur</label>
			      		</div>
		            	<div class="form-group">
		              		<input id="password-field" type="password" class="form-control" name="mdpconnect" value="" required>
		              		<label class="form-control-placeholder" for="password">Mot de passe</label>
		              		<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            	</div>
		            	<div class="form-group">
		            		<input type="submit" class="form-control btn btn-primary rounded submit px-3" name="formconnexion" value="Connexion"></input>
		            	</div>
		            	<div class="form-group d-md-flex">
		            		<div class="w-50 text-left">
			            		<label class="checkbox-wrap checkbox-primary mb-0">Se souvenir de moi
									<input type="checkbox" name="remember">
										<span class="checkmark"></span>
								</label>
							</div>
							<div class="w-50 text-md-right">
								<a href="#">Mot de passe oublié</a>
							</div>
		            	</div>
		          	</form>
				  <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

