<?php
if(isset($_POST["insertt"]))
{
	print_r($_POST["insertt"]);
	echo "<br>";
	// exit();
 $conn = mysqli_connect("localhost", "root", "newpass", "checkboxAjx");
 $query = "INSERT INTO checkbox(name) VALUES ('".$_POST["insertt"]."')";
 $result = mysqli_query($conn, $query);
 echo "Data Inserted Successfully!";
}
?>