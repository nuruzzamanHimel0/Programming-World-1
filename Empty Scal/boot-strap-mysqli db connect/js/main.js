$(document).ready(function(){


$(document).on("submit",'#sample_form',function(e){
	e.preventDefault();
	$('#message').val(" ");

	$.ajax({
		url:"check/upload.php",
		method:"POST",
		data: new FormData(this),
		dataType:'text',
		contentType:false,
		cache:false,
		processData:false,
		success:function(reflection)
		{
			if($.trim(reflection) != "")
			{
				console.log(reflection);
			}
		}
	});



});


});