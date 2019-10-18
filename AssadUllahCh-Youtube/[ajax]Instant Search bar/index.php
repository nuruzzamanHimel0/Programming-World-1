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
  <title>..Instant Live Search...</title>
</head>
<body>

  <div class="container">
    <div class="row my-5">
      <div class="col-md-6 offset-md-3 my-3">
        <h2> Instant Search:</h2>
      </div>

      <div class="col-md-6 offset-md-3">
        <form action="">
          <div class="form-group form-wrappaing">
          
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search......" name="q" id="q">
              <div class="input-group-append">
               
                <button class="input-group-text" id="basic-addon2">
                    <i class="fa fa-search"></i>
                </button>
              </div>
            </div>

            <div id="resultId"></div>
            <!-- <div class="result-wrapper">
              <ul>
                <li> <a href="#">This is PHP Course Title</a></li>
                <li> <a href="#">This is PHP Course Title</a></li>
                <li> <a href="#">This is PHP Course Title</a></li>
                <li> <a href="#">This is PHP Course Title</a></li>
              </ul>
            </div> -->
            

          </div>
        </form>

        
        
      </div>
    </div>
  </div>





  <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
