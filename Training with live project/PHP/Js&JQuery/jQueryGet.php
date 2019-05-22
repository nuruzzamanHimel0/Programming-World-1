<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JQuery Get</title>
		<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	
	<h1>Get Content - text(), html(), and val()</h1> <br><br>


	<p id="test">This is some <b>bold</b> text in a paragraph.</p>

<button id="btn1">Show Text</button>
<button id="btn2">Show HTML</button>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#btn1').on('click',function(){
			alert("text: "+ $('#test').text());
		});

		$('#btn2').click(function(){
			alert('html: '+ $('#test').html());
		});
	});
</script>
<br><br>

<input type="text" name="" value="Md.Nuruzzaman Himel" id="value">
<button id="sv">Show Value</button>

<script type="text/javascript">
	$(document).ready(function(){
		$('#sv').click(function(){
			alert('Value : '+ $('#value').val()  );
		});
	});
</script>

<br> <br>

<a href="www.google.com" id="w3s">Google.com</a> <br>
<button id="sl">Show Link</button>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#sl').click(function(){
			alert("show link:"+ $('#w3s').attr('href'));
		});
	});

</script>



</body>
</html>