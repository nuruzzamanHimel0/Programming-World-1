<?php 
header('Content-Type: application/json');


if(isset($_FILES['files']) && !empty($_FILES['files']))
{
	foreach ($_FILES['files']['name'] as $key => $name) {
		// echo $key. " ".$name;

		if($_FILES['files']['error'][$key] === 0)
		{
			$tmp_name = $_FILES['files']['tmp_name'][$key];
			// echo $tmp_name;

			$allowed = ['mp4','jpg','png','jpeg'];

			$div = explode('.',$name);
			$ext = strtolower(end($div));

			$newFile = substr(md5(time()),0,6).".".$ext;

			$uploaded = "uploads/".$newFile;

			// echo $newFile;

			if(in_array($ext,$allowed) && move_uploaded_file($tmp_name, $uploaded))
			{
				echo "Image Uploaded";
			}
		}
	}

}
    
/* 
 * End of script
 */