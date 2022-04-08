<?php $auth=0;
include 'lib/includes.php';

/**
*Traitement du formulaire
**/
	if (isset($_POST['username']) && ($_POST['password'])) {
		$username = $db->quote($_POST['username']);
		$password = sha1($_POST['password']);
		$sql = "SELECT * FROM users WHERE username=$username AND password='$password'";
		//var_dump($sql);
		$select=$db->query($sql);
		
		if(($select->rowcount())>0){			
			$_SESSION['Auth'] = $select->fetch();
			
			setFlash('Vous êtes maintenant connecté');
			header('Location:'.WEBROOT. 'admin/index.php');
			die();
			
		}
		/**if(($select->rowcount())>0 && ){			
			$_SESSION['Auth'] = $select->fetch();
			
			setFlash('Vous êtes maintenant connecté');
			header('Location:'.WEBROOT. 'utilisateur/index.php');
			die();
			
		}**/
	}

/**
*Inclusion du header
**/
include 'partials/header.php';
?>

<div class="jumbotron">
	<div class="container text-center">
    	<h1>My Portfolio</h1>      
    	<p>Some text that represents "Me"...</p>
	</div>
</div>

<div  class="container">
	<form action="#" method="post">
		<div class="form-group">
			<label for="username">Nom d'utilisateur</label>
			<!--<?php #echo input('username');?>-->
			<?=input('username');?>
		</div>
		<div class="form-group">
			<label for="password">Mot de passe</label>
			<?=input('password');?>
			<!--<input type="password" class= "form-control" id="password" name="password">-->
		</div>
		<button type="submit" class="btn btn-default">Se connecter</button>
	</form>
</div>
<?php //var_dump(WEBROOT);
#include 'lib/debug.php';?>
<?php #include 'partials/footer.php'; ?>