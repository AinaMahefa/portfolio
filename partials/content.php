<?php 
$select = $db->query("SELECT * FROM works");
$works = $select->fetchAll();

?>
<div class="jumbotron">
  <div class="container text-center">
    <h1>My Portfolio</h1>      
    <p>Some text that represents "Me"...</p>
  </div>
</div>
  
<div class="container-fluid bg-3 text-center" >    
  <h3>Some of my Work</h3><br>
  
      <div class="row">
        <?php foreach ($works  as $k => $work):?>

          <div class="col-sm-3">
            <a href="view.php"></a>
            
            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
          </div>
        <?php endforeach ?>
        <!--<div class="col-sm-3"> 
          <p>Some text..</p>
          <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        </div>
        <div class="col-sm-3"> 
          <p>Some text..</p>
          <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        </div>
        <div class="col-sm-3">
          <p>Some text..</p>
          <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        </div>
      -->
    </div>
  
</div><br>