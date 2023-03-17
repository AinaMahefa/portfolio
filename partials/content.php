<?php 
$select = $db->query("SELECT * FROM works");
$works = $select->fetchAll();

?>
<div class="jumbotron">
	<div class="container text-center">
		<h1>Jary Ainamahefa</h1>      
		<p>Passionné d’étude</p>
	</div>
</div>
	
<div class="container-fluid bg-3 text-center" >    
	<h3>Mes compétences</h3><br>
	
			<div class="row">
				<?php foreach ($works  as $k => $work):?>
					<div class="col-sm-3">
						<a href="view.php"></a>            
						<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
					</div>
				<?php endforeach ?>
				<div class="col-sm-3"> 
					<p>Nginx</p>
					<img src="<?= IMAGES.'\nginx.png'?>" class="img-responsive" style="width:100%" alt="Image">
				</div>
				<div class="col-sm-3"> 
					<p>Proxy Squid</p>
					<img src="<?= IMAGES.'\13.png'?>" class="img-responsive" style="width:100%" alt="Sary">
				</div>
				<div class="col-sm-3">
					<p>Pfsense</p>
					<img src="<?= IMAGES.'\pfsense.jpg'?>" class="img-responsive" style="width:100%" alt="Image">
				</div>
				<div class="col-sm-3">
					<p>Windows Server</p>
					<img src="<?= IMAGES.'\pfsense.jpg'?>" class="img-responsive" style="width:100%" alt="Image">
				</div>
		</div>
	
</div><br>