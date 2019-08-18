<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Uploader</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	
</head>
<body>

	<form action="upload.php" method="post" enctype="multipart/form-data" id="upload" class="upload"> 

		<fieldset>
			<legend> Upload Files</legend>
		<input type="file" id="file" name="file[]" required multiple>
		<input type="submit" id="submit" name="Submit" value="Upload">
		</fieldset>

		<div class="bar">
			<span class="bar-fill" id="pb">
				<span class="bar-fill-text" id="pt"></span>
			</span>
		</div>

		<div id="uploads" class="uploads">
			Uploaded file links will appear here.
			<a href="">file.txt</a>
			<a href="">file2.txt</a>

			<p>These files didn't uploaded:</p>
			<span>File1.txt</span>
			<span>File1.txt</span>
		</div>
<script type="text/javascript" src="js/upload.js"></script>
		<script type="text/javascript">

	document.getElementById('submit').addEventListener('click',function(e){
		e.preventDefault();
		// console.log('clicked');

		// alert($('#file').val());

		var f = document.getElementById('file');
			var pb = document.getElementById('pb');
			var pt = document.getElementById('pt');

			app.uploader({
				files: f,
				progressBar: pb,
				progressText: pt,
				processor: 'upload.php',
				finished: function(data)
				{
					console.log(data);
				},
				error: function()
				{
					console.log('now working');
				}
			});


	});		
			
			
		</script>
		
	</form>


	
</body> 
</html>