<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$from_user_id =  $_SESSION['user_id'];
		$to_user_id =  $_POST['to_user_id'];
		$chat_message =  $_POST['chat_message'];
		$status =  '1';
	
	
		$fetch_user_details = $pro->check_insert_chatting_message($to_user_id,$from_user_id,$chat_message,$status);
	
		// echo "from_user_id =".$from_user_id." to_user_id =".$to_user_id." chat_message =".$chat_message." status =".$status ;

		
	}

?>