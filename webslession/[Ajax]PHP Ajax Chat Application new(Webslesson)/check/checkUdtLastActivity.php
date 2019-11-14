<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login_details_id = $_SESSION['login_details_id'];
		
		$fetch_user_details = $pro->check_update_last_activity($login_details_id);
	
		// echo "update_last_activity ";

		
	}

?>