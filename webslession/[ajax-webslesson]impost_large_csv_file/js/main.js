$(document).ready(function(){


var clear_timer;

$(document).on('submit','#sample_form',function(event){

	event.preventDefault();

	$('#message').html("");

	$.ajax({
		url:"check/upload.php",
		method:"POST",
		data: new FormData(this),
		dataType:'json', // data come from whice type OR return type
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

					 // reset ALl value form from secton
					 $("#sample_form")[0].reset();

					 $('#import').css('disabled','disabled');

					 // 2.Start Import CSV file data using Ajax
					 start_import_into_DB_csv_value(); 

					 // 3.Display Import CSV File Data on progress bar using Ajax 
					 // RULE: setInterval(function_name,time in milisecound)
					 
					 clear_timer = setInterval(function(){
					 	get_import_data_into_DB();
					 },1000);


					
				}
				else if(reflection.error)
				{
					$('#message').html('<div class="alert alert-danger">'+reflection.error+'</div>');
				} 
				
				// console.log(reflection);
				
			}
			

		}


	});

	// alert('submitted');

});


function start_import_into_DB_csv_value()
{
	$('#process').css('display','block');

	$.ajax({
		url:'check/import.php', //import_csv_file_intoDB_mehtod()
		method:"POST",
		dataType:'text',
		success:function(data)
		{
			console.log(data);
		}
	});

}

function get_import_data_into_DB()
{
	$.ajax({
		url: "check/process.php",
		method:'POST',
		dataType:'text',
		success:function(data)
		{
			if($.trim(data) != "")
			{
				var total_data = $('#total_data').text();
				var width = (data/total_data)*100;


				$('#process_data').text(data);
				$('.progress-bar').css('width',width+'%');

				if(width >= 99)
				{
					clearInterval(clear_timer);
					$('#process').css('display','none');
					$('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
					$('#import').css('disabled','disabled');
					$('#import').val('Imported CSV File');
				}

				// console.log(width);
			}
		}
	});
}



});