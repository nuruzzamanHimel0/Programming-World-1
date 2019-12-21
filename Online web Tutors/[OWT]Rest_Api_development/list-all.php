<?php ini_set('display_errors', 1); ?>
<?php include 'inc/header.php'; ?>

<?php 
// include header............
	header('Access-Control-Allow-Origin: *'); // it allow all localhost,domian and sub-domain
	// header("Content-type: applicatin/json; charset=UTF-8"); // data which we are getting inside request
	header("Access-Control-Allow-Methods: GET");
	// type method
?>


<?php 
	
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$data = $stu->get_all_data();
		$students['records'] = array();

		if($data->num_rows > 0)
		{
			while ($rows = $data->fetch_assoc())
			{
				array_push($students['records'],array(
					'id' => $rows['id'],
					'name' => $rows['name'],
					'email' => $rows['email'],
					'mobile' => $rows['mobile'],
					'status' => $rows['status'],
					'created_at' => date('Y-m-d',strtotime($rows['created_at']))
				));
				// print_r($value);
			}
			// print_r($students);
			
			http_response_code(200); // status OK

			echo json_encode(array(
				'status' => 1,
				'data' => $students['records']
			));
		}

		

		// if()

	}
	else{
		http_response_code(503); // service not unavailable
		echo json_encode(array(
			'status' => 0,
			'message' => 'Access Denied'
		));
	}

?>






<?php include 'inc/footer.php'; ?>