<?php 
include '../lib/includes.php';
include 'admin_header.php';

/**
*SUPRESSION
**/
if (isset($_GET['delete'])) {
	# code...
	checkcsrf();
	$id=$db->quote($_GET['delete']);
	$db->query("DELETE FROM categories WHERE id=$id");
	
	setFlash('La catégorie a été bien supprimée');	
	header('Location:Categories.php');
	die();
}

/**
*Catégories
**/

$select=$db->query('SELECT id, name, slug FROM categories');
$categories=$select->fetchAll();

?>

<div class="container">

	<h1>Les Catégories</h1>
	<p><a href="category_edit.php" class="btn btn-success">Ajouter une nouvelle catégorie</a></p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($categories as $category):?>
			<tr>
				<td><?= $category['id'];?></td>
				<td><?= $category['name'];?></td>
				<td>
					<a href="category_edit.php?id=<?=$category['id'];?>&<?=csrf();?>" class="btn btn-default">Editer</a>
					<a href="?delete=<?=$category['id'];?>&<?=csrf();?>" class="btn btn-error" onclick="return confirm('Vous aller supprimer <?=$category['name'];?> de votre categories')">Supprimer</a>
				</td>
			</tr>	
			<?php endforeach; ?>
		</tbody>

	</table> 
</div>