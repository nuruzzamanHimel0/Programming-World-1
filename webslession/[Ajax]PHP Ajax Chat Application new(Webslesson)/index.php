<?php include('inc/header.php');  ?>
<style type="text/css">
  .container{
    display: none;
  }
  .preload{
    margin: 0px;
    position: absolute; 
    top:50%;
    left: 50%; 
    transform:translate(-50%, -50%);
  }
</style>
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
  <div class="preload">
      <img src="loading_spinner.gif" />
  </div>

 <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   
   <div class="table-responsive">
    <div class="col-md-8">
      <h4 align="center">Online User</h4>
    </div>
    <div class="col-md-4">
      <input type="hidden" id="is_active_group_chat_window" value="no" />
      <button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Group Chat</button>
    </div>
    <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="?action=logout">Logout</a></p>


    <div id="user-details"></div>

    <div id="user_model_details"></div>
    
   </div>
  </div>

<!-- ................... Group CHat dialog box.................... -->

  <div id="group_chat_dialog" title="Group Chat Window">
    <div id="group_chat_history" style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">
    </div>
    <div class="form-group">
      <textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>
    </div>
    <div class="form-group" align="right">
      <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
    </div>
  </div>

<?php include('inc/footer.php');  ?>


