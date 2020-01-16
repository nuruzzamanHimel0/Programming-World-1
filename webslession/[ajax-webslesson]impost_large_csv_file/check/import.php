<?php 
	
	  $filepath = realpath(dirname(__FILE__));
	  include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();


	// // header 
	// // 
	// header('Content-type: text/html; charset=utf-8');
	// header("Cache-Control: no-cache, must-revalidate");
	// header ("Pragma: no-cache");



	$inport_csv = $pro->import_csv_file_intoDB_mehtod();


?>