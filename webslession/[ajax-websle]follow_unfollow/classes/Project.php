<?php


class Project
{



	public function fetch_data($data)
	{
		$query = "SELECT DISTINCT customer_email FROM customer_table WHERE 
				customer_email LIKE ?
		 ";
		 $stmt = Database::prepare($query);
		 $stmt->execute(array("%".$data."%"));

		 $output = "";
		 if($stmt->rowCount() > 0)
		 {
		 	while ($row = $stmt->fetch()) 
		 	{
		 		$output .= '<li class="list-group-item contsearch">
   <a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;">'.$row["customer_email"].'</a>
  </li>';
		 	}

		 	echo $output;
		 	// echo "data found";
		 }
		 else{
		 	$output .= '<li class="list-group-item contsearch">
   <a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;">Data not Found !!</a>
  </li>';
  echo $output;
		 }
		// echo $data;
	}

	public function fetch_All_data($email)
	{

		 $query = "
		 SELECT * FROM customer_table 
		 WHERE customer_email = ?
		 LIMIT 1
		 ";

 		$stmt = Database::prepare($query);
 		$stmt->execute(array("".$email." "));

 		if($stmt->rowCount() > 0)
 		{
 			 $output = '
			 <table class="table table-bordered table-striped">
			  <tr>
			   <th>First Name</th>
			   <th>Last Name</th>
			   <th>Email</th>
			   <th>Gender</th>
			  </tr>
			 ';

			 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
			 {
				  $output .= '
				  <tr>
				   <td>'.$row["customer_first_name"].'</td>
				   <td>'.$row["customer_last_name"].'</td>
				   <td>'.$row["customer_email"].'</td>
				   <td>'.$row["customer_gender"].'</td>
				  </tr>
				  ';
			 }
			  $output .= '</table>';

			  echo $output;
 		}

	}


	
}


?>