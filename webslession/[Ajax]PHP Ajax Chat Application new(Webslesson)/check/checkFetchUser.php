<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$user_id =  $_SESSION['user_id'];
	
		// echo $q;
		// exit();
		$fetch_user_details = $pro->fetch_user_details_wo_login($user_id);
	
		// echo "User Details";

		
	}

?>