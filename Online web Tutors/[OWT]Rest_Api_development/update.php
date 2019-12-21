<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1) ?>

<?php 
	
	// include header............
	header('Access-Control-Allow-Origin: *'); // it allow all localhost,domian and sub-domain
	header("Content-type: applicatin/json; charset=UTF-8"); // data which we are getting inside request
	header("Access-Control-Allow-Methods: POST");
	// type method

	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$data = json_decode(file_get_contents('php://input'),true);

		if(!empty($data['name']) AND !empty($data['email']) AND !empty($data['mobile']) AND !empty($data['id']) )
		{
			$stu->name = htmlentities($data['name']);
			$stu->email = htmlentities($data['email']);
			$stu->mobile = htmlentities($data['mobile']);
			$stu->id = htmlentities($data['id']);

			if($stu->update_student())
			{
				http_response_code(200); // means OK
				echo json_encode(array(
					'status' => 1,
					'message' => "Student Update Successfully"
				));

			}
			else
			{
				http_response_code(500); // server error
				echo json_encode(array(
					'status' => 0,
					'messae' =>"Studnet update fail"
				));
			}

		}
		else{
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