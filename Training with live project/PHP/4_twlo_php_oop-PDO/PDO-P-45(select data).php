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

$id = 4;
$email = "korim@gmail.com";
// 1. SELECT ONE WAY....................(assoctiative Arry way)

$sql = "SELECT * FROM tbl_user WHERE id = :id AND email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":id" => $id,':email' => $email));

while ($value = $stmt->fetch()) {
	echo "Name : ".$value['name']."<br>";
}

// 2. SELECT ONE WAY....................(normal array way)

$sql = "SELECT * FROM tbl_user WHERE id = ? AND email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($id,$email));

while ($value = $stmt->fetch()) {
	echo "Name : ".$value['name']."<br>";
}


// 3. SELECT ONE WAY....................

$sql = "SELECT * FROM tbl_user WHERE id = ? AND email = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue('1',$id);
$stmt->bindValue('2',$email);
$stmt->execute();

while ($value = $stmt->fetch()) {
	echo "Name : ".$value['name']."<br>";
}



// 4. SELECT ONE WAY....................

$sql = "SELECT * FROM tbl_user WHERE id = :id AND email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id);
$stmt->bindValue(':email',$email);
$stmt->execute();

while ($value = $stmt->fetch()) {
	echo "Name : ".$value['name']."<br>";
}



// 3. SELECT SECOND WAY....................

$sql = "SELECT * FROM tbl_user ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($value = $stmt->fetch()) {
	echo "Name : ".$value['name']."<br>";
}




?>





<?php include "inc/footer.php"; ?>