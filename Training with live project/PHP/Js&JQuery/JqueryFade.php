<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<img src="image/pic_bulbon.gif">
<button id="ft">Fade Toggle</button>

<script type="text/javascript">
	$(document).ready(function(){
		$("#ft").on('click',function(){
			$('img').fadeToggle('slow');
		});
	});

</script>
	
</body>
</html>