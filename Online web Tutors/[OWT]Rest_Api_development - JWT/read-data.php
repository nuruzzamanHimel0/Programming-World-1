<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1); ?>
<?php 
 include("vendor/autoload.php");
 use \Firebase\JWT\JWT;
?>

<?php 
	
	// include header..............
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Method: POST");
header('Content-Type: Application/json; charset=UTF-8');

if($_SERVER['REQUEST_METHOD'] === "POST")
{
	// one way
	// $data = json_decode(file_get_contents("php://input"),true);

	// another way..(header added)

	$all_header = getallheaders();
	 $data['jwt'] = $all_header['Authorization'];
	if(!empty($data['jwt']))
	{
		try {
			$secret_key = 'owt1234';
			$jwt_token = $data['jwt'];

			$decode_data = JWT::decode($jwt_token,$secret_key,array('HS384'));


			$user_id = $decode_data->data->id;
			// $user_id = 10;

			http_response_code(200);
			echo json_encode(array(
				'status' => 1,
				'message' => "JWT available",
				'user_data' => $decode_data,
				'user_id' => $user_id
			));
		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(array(
				'status' => 0,
				'message' => $e->getMessage()
			));
		}

		
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