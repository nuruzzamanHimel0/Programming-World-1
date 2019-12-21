<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1); ?>
<?php 
 include("vendor/autoload.php");
 use \Firebase\JWT\JWT;
?>
<?php 

	// include headere 

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header('Content-Type: application/json; charset=UTF-8');


	if($_SERVER["REQUEST_METHOD"] === 'POST')
	{
		$data_body = json_decode(file_get_contents('php://input'),true);
		$all_header = getallheaders();

		if(!empty($data_body['project_name']) AND !empty($data_body['description']) AND !empty($data_body['status']) AND !empty($all_header['Authorization']) )
		{
			try {
				$secret_key = 'owt1234';
				$jwt_token = $all_header['Authorization'];

				$decode_data = JWT::decode($jwt_token,$secret_key,array('HS384'));

				$usr->user_id = $decode_data->data->id;
				$usr->project_name = $data_body['project_name'];
				$usr->description = $data_body['description'];
				$usr->status = $data_body['status'];

				if($usr->create_project())
				{
					http_response_code(200);
					echo json_encode(array(
						'status' => 1,
						'message' => "Project table date insert successfuly"
					));
				}
				else{
					http_response_code(500);
					echo json_encode(array(
						'status' => 0,
						'message' => "Not insert successuflly"
					));
				}

				
			} catch (Exception $e) {
				http_response_code(500);
				echo json_encode(array(
					'status' => 0,
					'message' => $e->getMessage()
				));
			}
		}
		else{
			http_response_code(404);
			echo json_encode(array(
				'status' => 0,
				'message' => "Data Needed"
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