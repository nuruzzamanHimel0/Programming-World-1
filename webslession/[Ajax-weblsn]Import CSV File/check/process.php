<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');

	$pro = new Project();

	$count_column = $pro->calculate_column_into_table();

?>