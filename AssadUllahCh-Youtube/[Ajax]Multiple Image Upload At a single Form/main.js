$(document).ready(function(){

	$("#upload").on('click',function(e){
		// console.log('uploaded');

		var form_data = new FormData();
		var inc = document.getElementById('image').files;
		var length = document.getElementById('image').files.length;

		for (var i =0 ; i<length; i++) 
		{
			form_data.append('files[]',document.getElementById('image').files[i]);
			// console.log(document.getElementById('image').files[i]);
		}

		$.ajax({
			url:"check/image_upload.php",
			method:'POST',
			cache: false,
			contentType: false,
			processData: false,
			data:form_data,
			async:false,
			dataType:'text', // get reflection as a TEXT
			beforeSend:function()
			{

			},
			success:function(reflection)
			{
				$('#gallery').html(reflection);
				console.log("Image Uploaded");
				// console.log(reflection);
			},
			complete:function(data)
			{

			},
			error:function(response)
			{

			}

		});



	});

})