<?php
 $filepath = realpath(dirname(__FILE__));

 // echo $filepath;
 include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Users.php');
	$db  = new Database();
	$usr = new Users();
?>
