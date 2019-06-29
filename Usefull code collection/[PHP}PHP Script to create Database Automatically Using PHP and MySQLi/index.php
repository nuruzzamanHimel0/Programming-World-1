<?php
$db_host = $this->sess->sess_get('db_host');
		$db_user = $this->sess->sess_get('db_user');
		$db_pass = $this->sess->sess_get('db_pass');
		$db_name = $this->sess->sess_get('db_name');	
// Database Create........................

		//_dbx is my connection variable
		$_dbx = new mysqli ($db_host,$db_user,$db_pass);
		//Checking Connection
		if ($_dbx->connect_error){
		 echo "Connection not detected".$_dbx->connect_error;
		}

		//we create the database with the following command;
		$database_sql = "CREATE DATABASE IF NOT EXISTS ".$db_name." ";
		if ($_dbx->query($database_sql) === FALSE){
		return true;
		}

		// create table.............................
		$table_sql1 = "CREATE TABLE IF NOT EXISTS ".$db_name.".perforn_info(ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, NAME VARCHAR(30) NOT NULL, EMAIL VARCHAR(100) NOT NULL)";

$table_sql2 = "CREATE TABLE IF NOT EXISTS ".$db_name.".card_Details(ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, personId INT NOT NULL,card_number VARCHAR(150) NOT NULL,Expaire_date DATETIME NOT NULL, CVC VARCHAR(30) NOT NULL)";

	if ($_dbx->query($table_sql1) === FALSE){
	echo "Table one not created: ".$_dbx->error;
	}
	if ($_dbx->query($table_sql2) === FALSE){
	echo "Table two not created: ".$_dbx->error;
	}

?>
