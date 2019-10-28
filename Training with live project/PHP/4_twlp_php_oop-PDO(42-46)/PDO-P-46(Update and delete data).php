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

$id = 1;
$skill = "JAVA, dfdfdf";

// // UPDATE ARRAY
// $sql = "UPDATE tbl_user SET skill = ? WHERE id = ? ";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(array($skill,$id));


// 2. UPDATE ASSOCIATIVE ARRAY
// $sql = "UPDATE tbl_user SET skill = :skill WHERE id = :id ";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(array(":skill"=>$skill,":id"=>$id));


// // 3. UPDATE  BIND PARAM.....................
// $sql = "UPDATE tbl_user SET skill = :skill WHERE id = :id ";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(":skill",$skill);
// $stmt->bindParam(":id",$id);
// $stmt->execute();



// 4. UPDATE  BIND PARAM.....................
$sql = "UPDATE tbl_user SET skill = ? WHERE id = ? ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam("1",$skill);
$stmt->bindParam("2",$id);
$stmt->execute();


// same way for delete...................



?>





<?php include "inc/footer.php"; ?>