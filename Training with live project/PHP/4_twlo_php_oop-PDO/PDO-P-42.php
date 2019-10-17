<?php include "inc/header.php"; ?>


<?php 
// dsn = data source name
$dsn = "mysql:dbname=userdata;host=localhost;";
$user = 'root';
$pass = "newpass";

try {
	$pdo = new PDO($dsn,$user,$pass);
} catch (PDOException $e) {
	echo "Connection Error.......".$e->getMessage();
	
}

$sql = "SELECT * FROM tbl_user";
$result = $pdo->query($sql);

foreach ($result as $value) {
	echo $value['skill']."<br>";
}




?>





<?php include "inc/footer.php"; ?>