<?php 

	$output = ' ';

	if(is_array($_FILES))
	{
		foreach ($_FILES['files']['name'] as $key => $value) {
			// echo $key." -- ".$value;
			$fileName = explode(".",$_FILES['files']['name'][$key]);
			 $allowed_ext = array("jpg", "jpeg", "png", "gif"); 
			 if(in_array($fileName[1],$allowed_ext))
			 {
			 	$newName = md5(rand()).".".$fileName[1];
			 	$tmp_name = $_FILES['files']['tmp_name'][$key];

			 	
			 	echo $tmp_name;
			 }

		}
	}










?>