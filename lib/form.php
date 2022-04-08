<?php

#<input type="text" class= "form-control" id="username" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}

function input($id){
	#$value = if(isset($_POST['$id'])){echo $_POST['$id'];};
	#        si----------------affiche---------------sinon---  
	$value = isset($_POST[$id])   ?    $_POST[$id] :    '';
	return "<input type='$id' class= 'form-control' id='$id' name='$id' value=$value>";

}

function textarea($id){
	$value = isset($_POST[$id])   ?    $_POST[$id] :    '';
	return "<textarea type='text' class= 'form-control' id='$id' name='$id'> $value</textarea>";
}

function select ($id, $options=array()){
	$return = "<select class='form-control' id='$id' name='$id'>";
		foreach ($options as $k => $v) {
			# code...
			$selected = '';

			if (isset($_POST[$id]) && $k == $_POST[$id]) {
				# code...
				$selected = ' selected="selected"';
				
			}
			$return .="<option value='$k' $selected>$v</option>";
		}
	$return .="</select>";
	return $return;
}