<?php include 'inc/header.php'; ?>
<?php ini_set('display_errors',1); ?>


<?php 
	// include header
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Method: GET");

	if($_SERVER['REQUEST_METHOD'] === "GET")
	{
		$result_obj = $usr->get_all_project();
		if($result_obj != FALSE)
		{
			// print_r($result_obj); 
			$project_array = array();
			while ($rows = $result_obj->fetch_assoc())
			{
				$project_array[] = array(
					"id" => $rows['id'],
					"user_id" => $rows['user_id'],
					"project_name" => $rows['project_name'],
					"description" => $rows['description'],
					"status" => $rows['status'],
					"created_at" => $rows['created_at']
				);
			}

			http_response_code(200);
			echo json_encode(array(
				'status' => 1,
				"project" => $project_array
			));

		}else{
			http_response_code(404);
			echo json_encode(array(
				'stauts' => 0,
				'message' => "Data not found"
			));
		}

	}
	else{
		http_response_code(500);
		echo json_encode(array(
			'status' => 0,
			'message' => "Inter Server Errorrr"
		));
	}


?>






<?php include 'inc/footer.php'; ?>