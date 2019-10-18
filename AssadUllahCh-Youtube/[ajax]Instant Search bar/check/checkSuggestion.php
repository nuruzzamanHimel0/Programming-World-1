<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/project.php');
	$pro = new project();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$q = $_POST['q'];
		// echo $q;
		// exit();
		$suggstion = $pro->getSuggestion($q);
		// echo $suggstion;
	}

?>