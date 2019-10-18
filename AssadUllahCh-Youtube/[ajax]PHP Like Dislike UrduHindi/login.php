<?php 
session_start();
if(isset($_GET['logout']))
{
  session_destroy();
  header('Location: login.php');
  exit();
}

if(isset($_SESSION['user_login']) AND $_SESSION['user_login'] == TRUE)
{
  header('Location: index.php');
  exit();
}
 $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/lib/Database.php');
  include_once ($filepath.'/classes/project.php');
  $db  = new Database();
  $pro = new project();

?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit']))
    {
      $email = $_POST['email'];
      $password = md5($_POST['password']);

      $message = $pro->userLogin($email,$password);
      // echo $email." ".$password;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="img/m.png">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/navbar-fixed.css">
  <link rel="stylesheet" href="style.css">
  <title>Building Like and Dislike Functionlity</title>
</head>
<body>

  <div class="container">
    
      <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light" href="#">Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Questions <span class="sr-only">(current)</span></a>
            </li>
            <?php
              if(isset($_SESSION['user_login']) AND $_SESSION['user_login'] == TRUE)
              {
            ?>
                <li class="nav-item">
              <a class="nav-link" href="?logout=logout">logout</a>
            </li>
               
            <?php    
              }else{
            ?>
                <li class="nav-item">
                 <a class="nav-link" href="login.php">Login</a>
               </li>
            <?php    
              }
            ?>
            
        </div>
      </nav>

      <div class="mt-2 bg-primary p-4 text-center">
        <h2 class="text-light">Building Like and Dislike Functionlity</h2>
      </div>

      <div class="row  justify-content-center">
        <div class="col-md-4 mt-3 text-center">


          <h3  class="mb-3">Login Here</h3>
      <?php 
          if(isset($message))
          {
            echo "<span style='color:red;'> ".$message."</span>";
          }

      ?>    
          <form action="" method="POST">
            <div class="form-group">
              <label for="exampleInputEmail1" class="lead">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="lead">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-2" style="font-weight: bold;">Submit</button>
          </form>



        </div>
      </div>

  </div>




  <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
  <script src="main.js"></script>
</body>
</html>
