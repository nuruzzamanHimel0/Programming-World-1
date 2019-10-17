<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Uploader</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	
</head>
<body>

	<script type="text/javascript">

	$(document).ready(function(){

		$('#upload').on('click',function(){

			var form_data = new FormData();
			var ins = document.getElementById("multiFiles").files;

			// console.log(ins);

			for(var x=0; x < ins.length; x++)
			{
form_data.append('files[]',document.getElementById("multiFiles").files[x]);
			}

			$.ajax({
				url:'upload.php', // point to server-side PHP script 
				dataType:'text', // what to expect back from the PHP script
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				method:'post',
				success:function(reflection)
				{
					console.log(reflection);
				}

			});



		});



	});




            
    </script>


<p id="msg"> </p>

        <input type="file" id="multiFiles" name="files[]" multiple="multiple"/>

 <button id="upload">Upload</button>

	
</body> 
</html>