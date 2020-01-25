$(document).ready(function(){

  var count = 0;
  $(document).on('click','.add',function(e){

    e.preventDefault();
    // console.log("Clicked"); 
    // 
    count++;

    
    $.ajax({
      url:'check/addedRow.php', //import_csv_file_intoDB_mehtod()
      method:"POST",
      data:{count:count},
      dataType:'text',
      success:function(data)
      {
        console.log(data);
      }
    });
    // console.log(count);

    
  });



});