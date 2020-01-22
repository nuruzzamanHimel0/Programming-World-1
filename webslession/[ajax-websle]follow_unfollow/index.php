<?php include 'inc/header.php'; ?>
  <style> 
  .mark {
    font-weight: bold;
                color: red;
  }

  .mark .gsearch{
    font-size: 20px
  }

  .unmark {
    background-color: #e8e8e8 !important
  }

  .unmark .gsearch{
    font-size: 10px
  }
  
  .marktext
  {
   font-weight:bold;
   background-color: antiquewhite;
  }
  </style>
<br />
  <br />
  <div class="container">
   <h3 align="center">jQuery Auto Suggest Textbox with Bootstrap 4 using PHP Ajax</h3>
   <br />
   <br />
   <div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-8">

       <input type="text" id="gsearchsimple" class="form-control input-lg" placeholder="Search..." />

       <ul class="list-group">

       </ul>

       <div id="localSearchSimple"></div>

       <div id="detail" style="margin-top:16px;"></div>
     
    </div>


    <div class="col-md-3"></div>
   </div>
  </div>



<?php include 'inc/footer.php'; ?>