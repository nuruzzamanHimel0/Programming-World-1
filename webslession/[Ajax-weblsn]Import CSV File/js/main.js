$(document).ready(function(){

var clear_timer;

$(document).on('submit','#sample_form',function(event){

	event.preventDefault();

	$('#message').html("");

	$.ajax({
		url:"check/upload.php",
		method:"POST",
		data: new FormData(this),
		dataType:'json',
		contentType:false, // header false
		cache:false,
		processData:false, //If you want to send a DOMDocument, or other non-processed data either any string, set this option to false.
		success:function(reflection)
		{
			if($.trim(reflection) != "")
			{
				if(reflection.success)
				{
					// file total input value set
					$('#total_data').text(reflection.total_line);

					 $('#message').html('<div class="alert alert-success">CSV File Uploaded</div>');
					 // 2.Start Import CSV file data using Ajax
					 start_import_into_DB_csv_value();
					 
					 // 3.Display Import CSV File Data on progress bar using Ajax 
					 // RULE: setInterval(function_name,time)
					 clear_timer = setInterval(get_import_data_into_DB,2000);
					 
				}
				else if(reflection.error)
				{
					$('#message').html('<div class="alert alert-danger">'+reflection.error+'</div>');

				
					// 
					// console.log(reflection.error);
				}

				// console.log(reflection);
			}

		}


	});

	// alert('submitted');

});
// 2.Start Import CSV file data using Ajax
function start_import_into_DB_csv_value()
{
	$('#process').css('display','block');
	$.ajax({
			url:"check/import.php", //import_csv_file_mehtod
			method:"POST",
			dataType:'text',
			success:function(reflection)
			{

				// console.log(reflection);
			}
	});


}


function get_import_data_into_DB()
{
	$.ajax({
	    url:"check/process.php",  //calculate_column_into_table
		success:function(data)
		{
			if($.trim(data) != "")
			{
				var total_data = $('#total_data').text();
				var width = Math.round((data/total_data)*100);

				$('#process_data').text(data);
				$('.progress-bar').css('width',width+'%');

				if(width >= 100)
				{
					clearInterval(clear_timer);

					$('#process').css('display','none');
					$('#file').val("");
					$('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
					$("#import").attr('disabled','disabled');
					$('#import').val('Imported...');

					 clear_database_data();
				}

				// console.log(data+"  --- "+total_data);
			}

		}
	});
}

function clear_database_data()
{
	$.ajax({
		url:"check/delete_data_into_db.php",
		success:function(reflection)
		{

		}
	});
}




});