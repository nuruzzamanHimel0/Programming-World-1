<?php include 'inc/header.php'; ?>
<?php ini_set('display_errors',1); ?>
<?php 
 include("vendor/autoload.php");
 use \Firebase\JWT\JWT;
?>

<?php 
	// include header............
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Method: POST');
	header("Content-type: application/json; charset=UTF-8");


	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$data = json_decode(file_get_contents("php://input"),true);
		// menual data
		$usr->email = $data['email'];
		$usr->password = $data['password'];

		if(!empty($data['email']) AND !empty($data['password']))
		{
			$user_result = $usr->check_login();
			if($user_result != FALSE)
			{
				// database data
				$password_hash = $user_result['password'];
				if(password_verify($data['password'], $password_hash))
				{
					$iss = "localhost";
					$iat = time();
					$nbf = $iat+10; // issue + 10 sec 
					$exp = $iat + 180; // issue + 30 s
					$aud = 'myuser'; // myuser are my audience
					$user_arr_data = array(
						'id' => $user_result['id'] ,
				    	'name' => $user_result['name'],
				    	'email' => $user_result['email'] 
					);

					$secret_key = 'owt1234';
					$payload_info = array(
				    "iss" =>$iss,
				    "iat" =>$iat ,
				    'nbf' =>$nbf ,
				    'exp' => $exp,
				    'aud' => $aud,
				    'data' => $user_arr_data
					);



					$jwt = JWT::encode($payload_info, $secret_key,'HS384');


					http_response_code(200);
					echo json_encode(array(
						'status' => 1,
						'jwt' =>$jwt,
						'message' => "Logged In Successfully"
					));

				}else{
					http_response_code(404);
					echo json_encode(array(
						'stauts'=> 0,
						'message' => 'Invalide Cradentialllll'
					));
				}
			}
			else{
				http_response_code(404);
				echo json_encode(array(
					'stauts'=> 0,
					'message' => 'Invalide Cradential'
				));
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