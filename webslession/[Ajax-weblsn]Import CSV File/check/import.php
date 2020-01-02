<?php 
	
	 $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Project.php');

	// header 
	// 
	header('Content-type: text/html; charset=utf-8');
	header("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

	$pro = new Project();

	$inport_csv = $pro->import_csv_file_intoDB_mehtod();

?>