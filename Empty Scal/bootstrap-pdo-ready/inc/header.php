<?php
 $filepath = realpath(dirname(__FILE__));
 // echo $filepath;
 include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');

	$pro = new Project();
?>
<!doctype html>
<html>
<head>
	<title>Ajax Essential Projects</title>


	 <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/navbar-fixed.css">
  <!-- <link rel="stylesheet" href="css/jquery-ui.css"> --> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap-tokenfield.min.css">
  <link rel="stylesheet" href="css/main.css">

</head>
<body>

<div class="project">
	<section class="headeroption">
		<h2>PHP OOP, jQuery, Ajax Essential Projects</h2>
	</section>
<section class="maincontent">