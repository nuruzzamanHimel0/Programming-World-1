<?php

$host= "localhost";
$username ="root";
$password="";
$dbname ="db_my_api";
$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error)
{
	echo "COnnection Error No =".$conn->connect_errno." AND ERRPR =".$conn->connect_errno;
}
// else{
// 	echo "Database Connected";
// }