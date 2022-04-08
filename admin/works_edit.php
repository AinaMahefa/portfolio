<?php 
include '../lib/includes.php';

/**
* La sauvegarde 
**/
if (isset($_POST['name']) && isset($_POST['slug']) && isset($_POST['content']) && isset($_POST['categorie_id'])) {
	# code...
	//var_dump($_POST);
	//var_dump($_FILES);
	//die();
	checkcsrf();
	$slug= $_POST['slug'];
	if (preg_match('/^[a-z\-0-9]+$/', $slug)) {
		# code...
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($slug);
		$content = $db->quote($_POST['content']);
		$categorie_id = $db->quote($_POST['categorie_id']);

		/**
		* SAUVEGARDE de la réalisation
		**/
		if (isset($_GET['id'])) {
			# code...
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE works SET name=$name, slug=$slug, content=$content, categorie_id=$categorie_id WHERE id=$id");
			//$_GET['id'] = $db->lastInsertId();
		}else{
			$db->query("INSERT INTO works SET name=$name, slug=$slug, content=$content, categorie_id=$categorie_id");
			$_GET['id'] = $db->lastInsertId();
		}
		setFlash('La réalisation a bien été éditée','success');
		//header('Location:works.php');
		//die();
		/**
		* ENVOIS DES IMAGES
		**/
		$work_id= $db->quote($_GET['id']);
		$files = $_FILES['images'];
		$images =array();
		foreach ($files['tmp_name'] as $key => $value) {
			# code...
			
			$image  = array('name' =>$files['name'][$key], 'tmp_name'=>$files['tmp_name'][$key]);
		
			$extension = pathinfo($image['name'], PATHINFO_EXTENSION);

			if (in_array($extension, array('jpg','png'))) {
			# code...
			$db->query("INSERT INTO image SET work_id = $work_id,name=''");
			$image_id= $db->lastInsertId();

			$image_name=$image_id.'.'.$extension;
			move_uploaded_file($image['tmp_name'], IMAGES.'works'.DIRECTORY_SEPARATOR.$image_name);
			$image_name=$db->quote($image_name);
			$db->query("UPDATE image SET name=$image_name WHERE id=$image_id");
			
			}	
		}
		
	}else{
		setFlash("L'url n'est pas valide","danger");
		
		//echo "Le slug n'est pas valide";
	}
	
}

/**
* On recupère une réalisation
**/
if (isset($_GET['id'])) {
	# code...
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM works WHERE id= $id");
	if ($select->rowCount()==0) {
		# code...
		setFlash("Il n'y a pas de réalisation pour cet id", "danger");
		header('Location:works.php');
		die();
	}
	$_POST = $select->fetch();
} 

/**
* Suppression d'une image
**/
if (isset($_GET['delete_image'])) {
	# code...
	checkcsrf();
	$id= $db->quote($_GET['delete_image']);
	$select = $db->query("SELECT name, work_id FROM image WHERE id=$id");
	$image = $select->fetch();
	unlink(IMAGES.'works/'.$image['name']);
	$db->query("DELETE FROM image WHERE id=$id");
	setFlash("L'image a été bien supprimée");
	header("Location:works_edit.php?id=".$image['work_id']);
	die();
}
/**
*  SELECTION categories
**/
$select =$db->query('SELECT id,name FROM categories ORDER BY name ASC');
$categories=$select->fetchAll();
$categories_list = array();
foreach ($categories as $category) {
	# code...
	$categories_list[$category['id']] = $category['name'];
}

/**
*  SELECTION Images
**/
if (isset($_GET['id'])){
	$work_id = $db->quote($_GET['id']);
	$select =$db->query("SELECT id,name FROM image WHERE work_id = $work_id");
	$images=$select->fetchAll(); 
}else{
	$images =array(); 
}


include 'admin_header.php';

?>


<div class="container">
<?php flash();?>
	<h1>Editer une réalisation</h1>

	<div class="row">
		<div class ="col-sm-8">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Nom de la réalisation</label>
					<!--<?php #echo input('username');?>-->
					<?=input('name');?>
				</div>
				<div class="form-group">
					<label for="slug">URL de la réalisation</label>
					<!--<?php #echo input('username');?>-->
					<?=input('slug');?>
				</div>
				<div class="form-group">
					<label for="content">Contenu de la réalisation</label>
					<!--<?php #echo input('username');?>-->
					<?=textarea('content');?>
				</div>
				<div class="form-group">
					<label for="categorie_id">Categorie</label>
					<!--<?php #echo input('username');?>-->
					<?=select('categorie_id', $categories_list);?>
		
				</div>
				<?php echo csrfInput();?>
				<div class="form-group">
					<input type="file" name="images[]">
					<input type="file" name="images[]" class="hidden" id="duplicate">
				</div>
				<p>
					<a href="#" class="btn btn-default" id="duplicatebtn">Ajouter une image</a>
				</p>
				<button type="submit" class="btn btn-success">Enregistrer</button>
			</form>
		</div>
		<div class="col-sm-4" >
			<?php foreach($images as $k => $image):?>
				<a href="?delete_image=<?=$image['id'];?> & <?=csrf();?>" onclick="return confirm('Etes-vous sur de supprimer l\'image:<?=$image['name'];?>?')">
				<img src="../images/works/<?= $image['name']?>" width="150"></a>
				
			<?php endforeach?>

		</div>
	</div>

</div>

<?php ob_start();?>
<script src="../jquery.min.js"></script>
<script>	
	(function ($) {
		// body...
		$('#duplicatebtn').click(function(e){
			e.preventDefault();
			var $clone = $('#duplicate').clone().attr('id','').removeClass('hidden');
			$('#duplicate').before($clone);
		})
	})(jQuery);
</script>
