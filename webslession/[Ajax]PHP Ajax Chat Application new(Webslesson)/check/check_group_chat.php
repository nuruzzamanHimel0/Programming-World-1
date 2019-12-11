<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST' )
	{

		if($_POST['action'] == 'insert_data')
		{
			$from_user_id =  $_SESSION['user_id'] ;
			$chat_message =  $_POST['chat_message'];
			$status = '1';
			
			$fetch_group_chat_history = $pro->insert_group_chat($from_user_id,$chat_message,$status);
		}
		else if($_POST['action'] == 'fetch_data')
		{
			// echo $_POST['action'];  

			echo $fetch_group_chat_history = $pro->fetch_group_chat_history();
		}
		
		
		// echo $from_user_id." -- ".$chat_message;
		
	}

?>