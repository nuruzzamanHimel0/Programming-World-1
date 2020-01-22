<?php 
	
	  $filepath = realpath(dirname(__FILE__));
	  include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['query']))
		{
			$query = $_POST['query']; 

			$fetch_data = $pro->fetch_data($query);
		}

		if(isset($_POST['email']))
		{
			$email = $_POST['email'];
			$fetch_data = $pro->fetch_All_data($email);
			// echo $_POST['email'];
		}
		

	
	}



?>