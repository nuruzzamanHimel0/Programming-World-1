<?php


class Project
{


	public function import_csv_file_intoDB_mehtod()
	{
		session_start();
		// // required sepecal.................
		// set_time_limit(0);
		// ob_implicit_flush(1);

		if(isset($_SESSION['csv_file_name']))
		{
 			// required sepecal.................

 			$read_file = fopen("../files/".$_SESSION['csv_file_name'],'r');

 			$counter = 0;

 			$store_lat_id="";

 			while ($row = fgetcsv($read_file)) 
 			{
 				if($counter > 0)
 				{
 					$data = array(
 						'first_name' => $row[0],
 						'last_name' => $row[1],
 						'email' => $row[2],
 						'gender' => $row[3],
 						'product' => $row[4],
 						'price' => $row[5],
 						'date' => $row[6]
 					);

 					$query = "INSERT INTO customer_table(customer_first_name,customer_last_name,customer_email,customer_gender) VALUES(?,?,?,?)";
 					$stmt = Database::prepare($query);
 					$stmt->execute(array($row[0],$row[1],$row[2],$row[3]));

 					 $lastId = Database::connection()->lastInsertId();
 				
 					$query2 = "INSERT INTO order_table(customer_id,product_name,product_price,order_date) VALUES(?,?,?,?)";
 					$stmt1 = Database::prepare($query2);
 					$execute = $stmt1->execute(array($lastId,$row[4],$row[5],$row[6]));

 					if($execute)
 					{
 						// sleep(1);
 						// if(ob_get_level() > 0)
						 //  {
						 //   ob_end_flush();
						 //  }
 					}

 				}
 				$counter++;
 				
 			}

 	

 			


		}
		
	}

	public function get_import_data_into_DB()
	{
		$query = "SELECT * FROM customer_table";
		$stmt = Database::prepare($query);
		$stmt->execute();

		if($stmt->rowCount() > 0)
		{
			echo $stmt->rowCount();
		}
	}

	


	
}


?>