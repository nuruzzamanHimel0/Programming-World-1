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
// Difference between bindParam and bindValue: bindParam sudu string pass kore but bindValue direct value pass kore ex: 

$sql = " INSERT INTO tbl_user(name,email,skill,age) VALUES(:name,:email,:skill,:age)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":name",$name);
$stmt->bindParam(":email",$email);
$stmt->bindParam(":skill",$skill);
$stmt->bindParam(":age",$age);

OR: 

$stmt->bindValue(":name","Himel");
$stmt->bindValue(":email",$email);
$stmt->bindValue(":skill",$skill);
$stmt->bindValue(":age",30);

$stmt->execute();





?>





<?php include "inc/footer.php"; ?>