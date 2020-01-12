<?php include 'inc/header.php'; ?>
<div class="container">
  <h1 align="center">Import CSV File Data with Progress Bar in PHP using Ajax - 3</h1>
  <br />
  <div class="card card-default">
    <div class="card-heading">
      <h3 class="card-title">Import CSV File Data</h3>
    </div>
    <div class="card-body">
      <span id="message">Nothifcation ..</span>


      <form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">

        <div class="form-group">
          <label class="col-md-4 control-label">Select CSV File</label>
          <input type="file" name="file" id="file" />
        </div>
        <div class="form-group" align="center">
          <input type="hidden" id="hidden_field" name="hidden_field" value="1" />
          <input type="submit" name="import" id="import" class="btn btn-info" value="Import"  />
        </div>

      </form>


      <div class="form-group" id="process" style="display:none;">

        <div class="progress">

          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"  >

          <p>
            <span id="process_data" >0</span> - <span id="total_data">0</span>
          </p>
            
          </div>



        </div>

  


      </div>


    </div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>