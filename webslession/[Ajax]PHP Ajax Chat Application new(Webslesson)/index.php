<?php include('inc/header.php');  ?>
<?php

session_start();

if(!isset($_SESSION['user_id']))
{
 header('location:login.php');
}
?>
<?php 
    if(isset($_GET['action']) AND $_GET['action'] == 'logout')
    {

       session_destroy();
          header('Location: login.php');
          exit();

   
    }
?>

 <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   
   <div class="table-responsive">
    <h4 align="center">Online User</h4>
    <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="?action=logout">Logout</a></p>


    <div id="user-details"></div>

    <div id="user_model_details"></div>
    
   </div>
  </div>

<?php include('inc/footer.php');  ?>