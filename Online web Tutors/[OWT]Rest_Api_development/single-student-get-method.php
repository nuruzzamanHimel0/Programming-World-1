<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1) ?>

<?php 

// include header............
	header('Access-Control-Allow-Origin: *'); // it allow all localhost,domian and sub-domain
	
	header("Access-Control-Allow-Methods: GET");
	// type method

	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$student_id = isset($_GET['id']) ? intval($_GET['id']) : "";

		if(!empty($student_id))
		{
			$stu->id = $student_id;

			$student_data = $stu->get_single_student();
				if($student_data != FALSE)
			{
				// Data found into the DB
				http_response_code(200); // status Ok
				echo json_encode(array(
					'status'=> 1,
					'message' => $student_data
				));
			}
			else{
				// Data not found into the DB

				http_response_code(404); // not found
				echo json_encode(array(
					'status' => 0,
					'message' => "Data not found"
				));
			}
		}
	}
	else
	{
		http_response_code(503) // 503 mens this serivce unavailable
		; //503 service unabailable
			echo json_encode(array(
				'stauts' => 0,
				'message' => "Access Deny"
			));
	}



?>




<?php include 'inc/footer.php'; ?>