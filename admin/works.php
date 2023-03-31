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
	$db->query("DELETE FROM works WHERE id=$id");
	
	setFlash('La réalisation a été bien supprimée');	
	header('Location:works.php');
	die();
}

/**
*réalisations
**/

$select=$db->query('SELECT id, name, slug, content, categorie_id FROM works');
$works=$select->fetchAll();

?>

<div class="container">

	<h1>Mes Réalisations</h1>
	<p><a href="works_edit.php" class="btn btn-success">Ajouter une nouvelle réalisation</a></p>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($works as $work):?>
			<tr>

				<td><?= $work['id'];?></td>
				<td><?= $work['name'];?></td>
				<td>
					<a href="works_edit.php?id=<?=$work['id'];?>&<?=csrf();?>" class="btn btn-default">Editer</a>
				</td>
				<td>
					<a href="?delete=<?=$work['id'];?>&<?=csrf();?>" class="btn btn-error" onclick="return confirm('Vous aller supprimer <?=$work['name'];?> de votre réalisation')">Supprimer</a>
				</td>
			</tr>	
			<?php endforeach; ?>
		</tbody>

	</table> 
</div>