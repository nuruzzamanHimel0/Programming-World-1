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
  <title>Multiple image upload</title>
</head>
<body>

  <br/><br/>  
           <div class="container">  

                

                     <div id="gallery"></div>
                       <div style="clear:both;"></div><br /><br />  

                       <div class="col-md-4" align="right">  
                            <label>Upload Multiple Image</label>  
                       </div> 

                       <div class="col-md-4">  
                            <input name="files[]" type="file" id="image" multiple />  
                       </div>  
                       <div class="col-md-4">  
                            <input type="submit" value="Submit" id="upload" />  
                       </div>  
                       <div style="clear:both"></div>  

           

           </div>  




  <script src="js/jquery.min.js"></script>
  <!-- <script src="js/popper.min.js"></script> -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>
  <script src="main.js"></script>
</body>
</html>
