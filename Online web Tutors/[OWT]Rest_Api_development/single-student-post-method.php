<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1) ?>
<?php 

	// include header............
	header('Access-Control-Allow-Origin: *'); // it allow all localhost,domian and sub-domain
	header("Content-type: applicatin/json; charset=UTF-8"); // data which we are getting inside request
	header("Access-Control-Allow-Methods: POST");
	// type method


	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$param = json_decode(file_get_contents("php://input"),true);

		if(!empty($param['id']))
		{

			$stu->id = $param['id'];

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

			// print_r($student_data);
		}
		else
		{
			http_response_code(500); // ok status
			echo json_encode(array(
				'stauts' => 0,
				'message' => "Faild Data found"
			));
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