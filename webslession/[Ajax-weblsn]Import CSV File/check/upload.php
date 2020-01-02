<?php 
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');
	// $pro = new Project();

	if($_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['hidden_field']))
	{

		$error = "";
		$total_line = "";
		session_start();

		$filename = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];

		if($filename != '')
		{
			$allow_extention  = array('csv');
			$file_array = explode('.',$filename);
			$extention = end($file_array);

			if(in_array($extention,$allow_extention))
			{
				$uniqid = substr(md5(uniqid(rand())),0,8);
				$new_file_name = $uniqid.".".$extention;
				$_SESSION['csv_file_name'] = $new_file_name;

				if(move_uploaded_file($tmp_name,"../files/".$new_file_name))
				{
					//Reads entire file into an array.......
					$file_content = file("../files/".$new_file_name,FILE_SKIP_EMPTY_LINES);
					$total_line = count($file_content);
					
					// echo $file_content;
				}
				else{
					 $error = "File not uploaded";
				}


				
			}
			else{
				    $error = 'Only CSV file format is allowed';

			}


			
		}
		else{
			  $error = 'Please Select File';
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
				'total_line' => $total_line
			);
		}

		echo json_encode($output);

	}

?>