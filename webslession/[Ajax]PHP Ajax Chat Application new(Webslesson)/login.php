<?php include('inc/header.php');  ?>
<?php 
session_start();
$message = '';
if(isset($_SESSION['user_id']))
{
 header('location:index.php');
}

	
	if(isset($_POST['login']))
	{
		$username  = $_POST['username'];
		$password  = md5($_POST['password']);
		$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'  LIMIT 1";
		$result = $db->select($query);
		if($result != FALSE)
		{
			while ($vlaue = $result->fetch_assoc()) 
			{


				if( md5($_POST["password"]) ==  $vlaue["password"])
				{
					$user_id = $vlaue['user_id'];
					 $_SESSION['user_id'] = $vlaue['user_id'];
     			 $_SESSION['username'] = $vlaue['username']; 

     			 $sub_query = "INSERT INTO login_details (user_id) VALUES ('$user_id')";

     			 $sub_result = $db->insert($sub_query);
     			  $_SESSION['login_details_id'] = $db->link->insert_id;
     			 if($sub_result != FALSE)
     			 {
     			 	header("location:index.php");
     			 	exit();
     			 }
				}
				 else{
     			 	$message = "<label>Wrong Password</labe>";
     			 }
				


			}
		}
		else{
			$message = "<label>Wrong Username</labe>";
		}


	}
?>

   <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Chat Application Login</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form>
    </div>
   </div>
  </div>
    </body> 

<?php include('inc/footer.php');  ?>