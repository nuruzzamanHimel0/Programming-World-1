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

$name = "Nuruzzaman";
$email ="nu@gmail.com";
$skill = "java";
$age = '20';

// insert one wayyyy.....................

$sql = " INSERT INTO tbl_user(name,email,skill,age) VALUES(:name,:email,:skill,:age)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":name",$name);
$stmt->bindParam(":email",$email);
$stmt->bindParam(":skill",$skill);
$stmt->bindParam(":age",$age);

$stmt->execute();


// 2. Second way to insert.............................

$sql = " INSERT INTO tbl_user(name,email,skill,age) VALUES(?,?,?,?)";
$stmt = $pdo->prepare($sql);
$arr = array($name,$email,$skill,$age);
$stmt->execute($arr);



?>





<?php include "inc/footer.php"; ?>