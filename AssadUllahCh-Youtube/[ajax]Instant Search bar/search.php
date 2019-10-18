<?php 
 $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/lib/Database.php');
  include_once ($filepath.'/classes/project.php');
  $db  = new Database();
  $pro = new project();

  if(!isset($_GET['id']) AND empty($_GET['id']))
  {
    header('index.php');
    exit();
  }
  else{
      $get_qk = $pro->get_question_keywords_id($_GET['id']);
      // echo $get_qk['question_id']."<br>";

      $get_page_reslt = $pro->get_question_keywords_result($get_qk['question_id'],$get_qk['keywords_id']);

      // echo $get_page_reslt['keywords_label']." ".$get_page_reslt['title']." ".$get_page_reslt['descriptions'];
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
  <title>..Instant Live Search...</title>
</head>
<body>

  <div class="container">
    <div class="row my-5">
<!--       <div class="col-md-6 offset-md-3 my-3">
        <h2> Instant Search:</h2>
      </div> -->


      <div class="col-md-6 offset-md-3">
        <ul>
          <li> 
              <h2><?php  echo $get_page_reslt['title']."<br><br>"; ?></h2>
          </li>
          <li> 
              <hp><?php  echo $get_page_reslt['descriptions']; ?></p>
          </li>
        </ul>
        <?php  echo "Keywords: ".$get_page_reslt['keywords_label']; ?>
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
