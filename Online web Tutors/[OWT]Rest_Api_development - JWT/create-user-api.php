<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1); ?>
<?php 
// include header............
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header("Content-type: application/json; charset=UTF-8");


	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$data = json_decode(file_get_contents('php://input'),true);
		

	
			if(!empty($data['name']) AND !empty($data['email']) AND !empty($data['password']))
			{
				
				$usr->name = $data['name'];
				$usr->email = $data['email'];
				$usr->password = password_hash($data['password'],PASSWORD_DEFAULT);

				if($usr->check_email())
				{

					// for same email address, data not inserted
					http_response_code(500);
					echo json_encode(array(
						'status'=> 0,
						'message' =>"Same Email not inserted"
					));
				}
				else{
					if($usr->create_user())
					{
						http_response_code(200);
						echo json_encode(array(
							'status' => 1,
							'message' => "Data Insert"
						));
					}
					else{
						http_response_code(500);
						echo json_encode(array(
							'status' => 0,
							'message' => 'Data Insert Fail'
						));
					}

				}
				

			}
			else{
				http_response_code(500); // internal server eror
				echo json_encode(array(
					'stauts' => 0,
					'message' => "All data needed"
				));
			}


		

		
	}
	else{
		http_response_code(503); // service unavailable
		echo json_encode(array(
			'status' => 0,
			'message' => 'Access Denie'
		));
	}

?>



<?php include 'inc/footer.php'; ?>