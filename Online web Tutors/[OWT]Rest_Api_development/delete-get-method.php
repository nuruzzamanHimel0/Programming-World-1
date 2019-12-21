<?php include 'inc/header.php'; ?>
<?php ini_set('display_error',1);  ?>


<?php 
	
	header("Access-Conrol-Allow-Origin: *");

	header("Access-Control-Allow-Method: GET");

	if($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		$student_id = isset($_GET['id']) ? $_GET['id'] : "";

		if(!empty($student_id))
		{
			$stu->id = $student_id;

			if($stu->delete_student() != FALSE)
			{
				http_response_code(200); //ok
				echo json_encode(array(
					'status'=>1,
					'message'=>'data delete successfully'
				));
			}
			else{
				http_response_code(500); //Server Eror
				echo json_encode(array(
					'status'=>1,
					'message'=>'Server Eror'
				));
			}
			
		}
		else{
			http_response_code(404); // data not found
			echo json_encode(array(
				'status'=> 0,
				'message' =>'data not found'
			));
		}
	}

?>



<?php include 'inc/footer.php'; ?>