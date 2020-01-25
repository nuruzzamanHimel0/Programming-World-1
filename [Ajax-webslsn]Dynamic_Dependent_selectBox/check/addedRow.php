<?php 
	
	  $filepath = realpath(dirname(__FILE__));
	  include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();


	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$count = $_POST['count'];

		$add = $pro->addedRowIntoBody($count);
		// echo $count;
	}

?>