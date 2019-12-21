<?php include 'inc/header.php'; ?>
<?php ini_set('display_errors',1); ?>
<?php 
 include("vendor/autoload.php");
 use \Firebase\JWT\JWT;
?>

<?php 
	// include Headers
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Method: GET");
	
	if($_SERVER['REQUEST_METHOD'] === "GET")
	{	
		$all_header = getallheaders();
		// jwt token
		$jwt_token = $all_header['Authorization'];
		$secret_key = 'owt1234';

		try {
			$decode_data = JWT::decode($jwt_token,$secret_key,array('HS384'));

			$usr->user_id = $decode_data->data->id;

			$get_all_user_obj = $usr->get_user_all_project();

			$project_arr = array();

			if($get_all_user_obj != FALSE)
			{

				while($rows = $get_all_user_obj->fetch_assoc())
				{
			$project_arr[] = array(
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
					'project' => $project_arr
				));
			}
			else{
				http_response_code(404);
				echo json_encode(array(
					'stauts' => 0,
					'message' => "Data not found"
				));
			}


			// print_r($decode_data);

		} catch (Exception $e) {
			http_response_code(500);
				echo json_encode(array(
					'status' => 0,
					'message' => $e->getMessage()
				));
		}

	}
	else
	{
		http_response_code(503); // service unavailable
		echo json_encode(array(
			'status' => 0,
			'message' => 'Access Denie'
		));
	}

?>


<?php include 'inc/footer.php'; ?>