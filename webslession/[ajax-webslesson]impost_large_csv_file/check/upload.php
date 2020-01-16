<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	  include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$error = "";
		$total_line = "";
		session_start();

		$file_name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];

		// echo $file_name;

		if($file_name != "")
		{
			// extention check 
			$allow_extention = array('csv');
			$file_array = explode('.',$file_name);
			$new_extention = strtolower(end($file_array));

			if(in_array($new_extention,$allow_extention))
			{
				// new file created 
				$uniqid = substr(uniqid(rand()),0,9);
				$new_file_name = $uniqid.".".$new_extention;
				// file save 
				if(move_uploaded_file($tmp_name,"../files/".$new_file_name))
				{
					// Reads entire file into an array
					$file_length = file("../files/".$new_file_name,FILE_SKIP_EMPTY_LINES);
					$total_line = count($file_length);
					$_SESSION['csv_file_name'] = $new_file_name;
					$_SESSION['csv_file_tmp_name'] = $tmp_name; 



				}

			}else
			{
				  $error = "FIle would be CSV file only!! ";
			}
		}
		else{
			  $error = "File Can't Empty";
		}


		if($error != "")
		{
			$output = array(
				'error' => $error
			);
		}
		else{
			$output = array(
				'success' => true,
				'total_line' => $total_line-1
			);
		}


		echo json_encode($output);

	}

?>