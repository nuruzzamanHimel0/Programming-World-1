<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();

	$id = $_GET['id'];
		$getRef = $pro->getRefresh($id);
	

?>