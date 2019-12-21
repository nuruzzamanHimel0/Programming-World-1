<?php include 'inc/header.php'; ?>

<?php 
	header('Content-Type: application/json'); 

	// $requerst = $_SERVER['REQUEST_METHOD'];

	// switch ($requerst) 
	// {
	// 	case 'POST':
	// 		// echo '{" name ":"POST"}';
	// 		postCreate();

	// 	break;
	// 	case 'GET':
	// 		echo '{" name ":"GET"}';
	// 	break;
	// 	case 'PUT':
	// 		echo '{" name ":"PUT"}';
	// 	break;
	// 	case 'DELETE':
	// 		echo '{" name ":"DELETE"}';
	// 	break;
		
	// 	default:
	// 		echo "Access denay";
	// 		break;
	// }

	// function postCreate()
	// {
	// 	global $stu;

	// 	$stu->name = "Himel timal";
	// 	$stu->email = 'himel@gmail.com';
	// 	$stu->mobile = '01622819929';

	// 	if($stu->create_data())
	// 	{
	// 		echo "Student Has been created";
	// 	}
	// 	else{
	// 		echo "Fail to insert data";
	// 	}
	// }
?>
 <?php include 'inc/footer.php'; ?>