<?php include 'inc/header.php'; ?>


<br />
    <div class="container" style="background: #fff;">
      <h3 align="center">Add Remove Dynamic Dependent Select Box using Ajax jQuery with PHP</h3>
      <br />
      <h4 align="center">Enter Item Details</h4>
      <br />

      <form method="post" id="insert_form">
        <div class="table-repsonsive">
          <span id="error"></span>
          <table class="table table-bordered" id="item_table">
            <thead>
              <tr>
                <th>Enter Item Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>
                    <button type="button" name="add" class="btn btn-success btn-xs add"><i class="fa fa-plus-square"></i></button>
                </th>
              </tr>
            </thead>

            <tbody></tbody>
            
          </table>
          <div align="center">
            <input type="submit" name="submit" class="btn btn-info" value="Insert" />
          </div>
          <br>
        </div>
      </form>


    </div>
<br>




<?php include 'inc/footer.php'; ?>