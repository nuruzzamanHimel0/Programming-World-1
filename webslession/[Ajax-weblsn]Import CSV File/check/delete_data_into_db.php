<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');



	$pro = new Project();

	$clear_data = $pro->clear_all_data_into_db();

?>