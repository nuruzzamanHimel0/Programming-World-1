<?php 
	
	include("db.php");

	header('content-type: application/json');

	$request=$_SERVER['REQUEST_METHOD'];

	switch ($request) {
		case 'GET':    // select
		echo getMethod();
		// echo "<pre>";
		// 	echo print_r(json_decode(getMethod()));
		break;
		case 'PUT':   // update
		 $data = json_decode(file_get_contents("php://input"),true);
		  updateMethod($data);
		break;
		case 'POST':  // insert
		$data=json_decode(file_get_contents("php://input"),true);
		  postMethod($data);

		break;
		case 'DELETE':
		  $data = json_decode(file_get_contents('php://input'),true);
		  deleteMethod($data);
		break;
		
		default:
			 echo '{ "name":"Dose not found" }';
			break;
	}

	function getMethod()
	{
		global $conn;

		$row = array();

		$query = "SELECT * FROM api_table";
		$stmt = $conn->query($query);

		if($stmt->num_rows > 0)
		{
			while ($value = $stmt->fetch_assoc()) {
				$row['result'][] = $value;
			}

			return json_encode($row);
			 // echo '{ "name":"get date" }';
		}
		else{
			 echo '{ "name":"Not get date" }';
		}
		 // echo '{ "name":"GET" }';
	}

	function postMethod($data)
	{
		global $conn;

		$fname = $data['fname'];
		$email = $data['email'];

		$query = "INSERT INTO api_table(`fname`,`email`,`date`) VALUES('$fname','$email',NOW())";
		$stmt = $conn->query($query);

		if($stmt)
		{
			echo '{"result": "data inserted"}';
		}else{
			echo '{"result": "data not inserted"}';
		}

	}

	function updateMethod($data)
	{
		global $conn;

		$fname = $data['fname'];
		$email = $data['email'];
		$id = $data['id'];

		// echo '{"result": "'.$id.'"}';


		$query = "UPDATE `api_table` SET `fname`='$fname',`email`='$email' WHERE id = '$id' ";
		$stmt = $conn->query($query);

		if($stmt)
		{
			echo '{"result": "data Update"}';
		}else{
			echo '{"result": "data Update Fail"}';
		}

	}

	function deleteMethod($data)
	{
		global $conn;
		$id = $data['id'];

		$query = "DELETE FROM api_table WHERE id = '$id' ";
		$stmt = $conn->query($query);

		if($stmt)
		{
			echo '{"result": "data Delete"}';
		}else{
			echo '{"result": "data Delete Fail"}';
		}

	}
	
	


?>