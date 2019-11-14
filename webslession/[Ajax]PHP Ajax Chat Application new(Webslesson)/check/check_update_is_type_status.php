<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login_details_id =  $_SESSION['login_details_id'] ;
		$is_type =  $_POST['is_type'];
		
		$fetch_chat_history = $pro->update_is_type_status($login_details_id,$is_type);
		
		// echo $login_details_id." -- ".$is_type;
		
	}

?>