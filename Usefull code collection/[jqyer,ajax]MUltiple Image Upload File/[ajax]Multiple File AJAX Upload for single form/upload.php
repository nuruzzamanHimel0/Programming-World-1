<?php 
header('Content-Type: application/json');

$uploaded = [];
$allowed = ['mp4','jpg','png','jpeg'];

$succeded = [];
$failed = [];

if(!empty($_FILES['file']))
{
	foreach ($_FILES['file']['name'] as $key => $name) {
		// echo $key." ".$name;
		// echo $_FILES['file']['error'][$key];

		if($_FILES['file']['error'][$key] === 0) // error not
		{
			$tmp = $_FILES['file']['tmp_name'][$key];
			// echo $tmp."<br>";

			$ext = explode('.',$name);
			// print_r($ext);
			$ext = strtolower(end($ext));

			$file = substr(md5(time()),0,5).".".$ext;
			// echo $file."<br>";

	if(in_array($ext,$allowed) === TRUE AND move_uploaded_file($tmp, "uploads/{$file}")
)
			{
				$succeded[] = array(
					"name" => $name,
					'file' => $file
				);
			}
			else{
				$failed[] = array(
					"name" => $name
					
				);
			}
		}
	}

if(!empty($_POST['ajax']))
{
	echo json_encode(
	array(
		'succeeded' => $succeded,
		'failed' => $failed
	));


}


}



