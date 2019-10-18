<?php 
session_start();
if(isset($_GET['logout']))
{
    session_destroy();
  header('Location: login.php');
  exit();
}
if(!isset($_SESSION['user_login']) AND $_SESSION['user_login'] != TRUE)
{
  header('Location: login.php');
  exit();
}
else{
  // echo $_SESSION['user_login'];
}
 $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/lib/Database.php');
  include_once ($filepath.'/classes/project.php');
  $db  = new Database();
  $pro = new project();
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
              if($_SESSION['user_login'] == TRUE)
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

      <div class="row">
        <?php 
          $pro->getResult();
        ?>
        <!-- <div class="col-md-12 mt-3">
          <h3>Question One</h3>
          <p class="lead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <hr class="my-1">
          <div class="footer-icon">
            <ul>


              <li>
                <a href="#" class="empty">
                  <i class="fa fa-thumbs-up"></i>
                  <span class="like-counter">1</span>
                </a>
              </li>

              <li>
                <a href="#"  class="like">
                  <i class="fa fa-thumbs-down"></i>
                  <span class="dislike-counter">2</span>
                </a>
              </li>


            </ul>
          </div>
        </div> -->


      </div>

  </div>




  <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
  <script src="main.js"></script>
</body>
</html>
