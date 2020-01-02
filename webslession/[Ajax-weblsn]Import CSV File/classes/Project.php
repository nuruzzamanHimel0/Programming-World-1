<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');

class Project{

	private $db;
	public function __construct(){
		$this->db = new Database();
	}
// 2.Start Import CSV file data using Ajax

	public function import_csv_file_intoDB_mehtod()
	{
		// required sepecal.................
		set_time_limit(0);
		ob_implicit_flush(1);

		session_start();

		if(isset($_SESSION['csv_file_name']))
		{	//read file
			$file_data = fopen("../files/".$_SESSION['csv_file_name'],'r');
			// fgetcsv($file_data);
			$output = '';


			while ($row = fgetcsv($file_data)) 
			{
				 $data = array(
				   'first_name' => $row[0],
				   'last_name' => $row[1]
				  );

				 $query = "INSERT INTO csv_table(firstname,lastname) VALUES('".$data['first_name']."','".$data['last_name']."')";
				$result = $this->db->insert($query);

				if($result != FALSE)
				{
					sleep(1);

					  if(ob_get_level() > 0)
					  {
					   ob_end_flush();
					  }
				}
				
			}
		unset($_SESSION['csv_file_name']);
		}
	}


	public function calculate_column_into_table()
	{
		$query = "SELECT * FROM csv_table";
		$result = $this->db->select($query);

		if($result != FALSE)
		{
			echo  $result->num_rows;
		}
	}

		public function clear_all_data_into_db()
	{
		$query = "DELETE FROM `csv_table`";
		$result = $this->db->delete($query);
	}


	


	
}
?>