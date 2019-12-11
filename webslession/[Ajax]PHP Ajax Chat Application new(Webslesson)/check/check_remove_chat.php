<?php 
	session_start();
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		// $login_details_id =  $_SESSION['login_details_id'] ;
		$chat_message_id =  $_POST['chat_message_id'];
		
		$fetch_chat_history = $pro->remove_chat_method($chat_message_id);
		
		// echo $chat_message_id;
		
	}

?>