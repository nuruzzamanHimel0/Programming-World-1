<?php 
	
	  $filepath = realpath(dirname(__FILE__));
	  include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../config/config.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../classes/Project.php');
	$pro = new Project();


	$data = array();

	if(isset($_GET["query"]))
	{
	 // echo $_GET["query"];

	$value = $_GET["query"];
	 $query = "
	 SELECT country_name FROM textBox_MS 
	 WHERE country_name LIKE ? 
	 ORDER BY country_name ASC 
	 LIMIT 15
	 ";

	 $statement = Database::prepare($query);

	 $statement->execute(array('%$value%'));

	 while($row = $statement->fetch(PDO::FETCH_ASSOC))
	 {
	  $data[] = $row["country_name"];
	 }
	}

	echo json_encode($data);

?>