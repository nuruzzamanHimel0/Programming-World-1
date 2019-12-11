<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

class Project{

	private $db;
	public function __construct(){
		$this->db = new Database();
	}


	


	
}
?>