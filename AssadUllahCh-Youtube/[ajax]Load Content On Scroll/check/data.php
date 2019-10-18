<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$offset = $_POST['offset'];
		$rows = $_POST['rows'];
	
		$get_data = $pro->get_data_from_videos($offset,$rows);
	

	
	}

?>