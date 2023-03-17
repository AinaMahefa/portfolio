<?php 
include '../lib/includes.php';

include 'admin_header.php';


if (isset($_POST['name']) && isset($_POST['slug'])) {
	# code...
	checkcsrf();
	$slug= $_POST['slug'];
	if (preg_match('/^[a-z\-0-9]+$/', $slug)) {
		# code...
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($slug);
		if (isset($_GET['id'])) {
			# code...
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE categories SET name=$name, slug=$slug WHERE id=$id");
		}else{
			$db->query("INSERT INTO categories SET name=$name, slug=$slug");
		}
		setFlash('La catégorie a bien été ajoutée','success');
		header('Location:Categories.php');
		die();
	}else{
		setFlash("Le slug n'est pas valide","danger");
		header('Location:Categories.php');
		die();
		
	}
}

if (isset($_GET['id'])) {
	# code...
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM categories WHERE id= $id");
	if ($select->rowCount()==0) {
		# code...
		setFlash("Il n'y a pas de catégorie pour cet id", "danger");
		header('Location:Categories.php');
		die();
	}
	$_POST = $select->fetch();
} 



?>


<div class="container">
<?php flash();?>
	<h1>Editer une catégorie</h1>

	<form action="#" method="post">
		<div class="form-group">
			<label for="name">Nom de la catégorie</label>
			<!--<?php #echo input('username');?>-->
			<?=input('name');?>
		</div>
		<div class="form-group">
			<label for="slug">URL de la catégorie</label>
			<!--<?php #echo input('username');?>-->
			<?=input('slug');?>
		</div>
		<?php echo csrfInput();?>
		<button type="submit" class="btn btn-default">Enregistrer</button>
	</form>

</div>