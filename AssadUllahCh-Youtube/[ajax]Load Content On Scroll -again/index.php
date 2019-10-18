
<?php 
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
  <title>Loading Dynamic Content on page scroll using AJAX</title>
</head>
<body>

  <div class="container">
    <h1>Dynamic Content</h1>

  </div>


<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
 -->

  <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
  <script src="main.js"></script>
</body>
</html>
