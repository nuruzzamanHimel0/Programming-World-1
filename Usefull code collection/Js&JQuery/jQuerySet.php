<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JQuery SET..............................</title>
		<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

	<h1>Get Content - text(), html(),val() and attr()</h1> <br><br>

	<p id="test1">This is a text paragraph.</p>
<p id="test2">This is another html paragraph.</p>

<p>Input field: <input type="text" id="test3" value="Mickey Mouse"></p>

<a href="https://www.w3schools.com/css/" title="CSS Tutorial" id='test4'>W3Schools.com</a>

<br><br>
<button id="btn1">Set Text</button>
<button id="btn2">Set HTML</button>
<button id="btn3">Set Value</button>
<button id="btn4">Set ATTR</button>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#btn1').click(function(){
			$("#test1").text('<b>Hello WOrld !!!</b>');
		});

		$('#btn2').on('mousedown',function(){
			$('#test2').html('<b>Hello WOrld !!!</b>')
		});

		$('#btn3').on('click',function(){
			$('#test3').val('Md. Nuruzzaman Himel');
		});

		$('#btn4').on('click',function(){
			$('#test4').attr('href','https://www.w3schools.com/jquery');
		});


	});
</script>




	
</body>
</html>