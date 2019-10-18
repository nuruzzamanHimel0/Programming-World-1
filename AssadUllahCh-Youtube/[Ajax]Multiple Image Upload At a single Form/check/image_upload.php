<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_FILES['files']) AND !empty($_FILES['files']))
		{
			$output = " ";
			foreach ($_FILES['files']['name'] as $key => $name) 
			{
				// echo $key." -- ".$name;
				$tmp_name = $_FILES['files']['tmp_name'][$key];

				// echo $tmp_name."<br>";

				$allowed_ext = array('jpeg','jpg','png','gif');

				$div = explode('.',$name);
				$ext = strtolower(end($div));
				$newFile = substr(md5(uniqid(rand())),0,10).".".$ext;
				// echo $newFile." -- ";
				$uploaded_url = "../upload/".$newFile;

				// echo $uploaded_url." -- ";

				$uploaded = "upload/".$newFile;

				if(in_array($ext,$allowed_ext) AND move_uploaded_file($tmp_name,$uploaded_url))
				{ 
					$output .= '<img src="'.$uploaded.'" width="150px" height="180px" />';
				}
			}

			echo $output;
		}

		// $suggstion = $pro->get_data_from_videos($offset,$rows);

		
		
	}

?>