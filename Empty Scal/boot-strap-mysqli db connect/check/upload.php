<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['hidden_field']))
	{
		$file_name = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];

		echo $file_name;
	}

?>