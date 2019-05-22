<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>jQuery Add............................</title>
	<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<h1>
	
    append() - Inserts content at the end of the selected elements,
    prepend() - Inserts content at the beginning of the selected e,
    after() - Inserts content after the selected elements,
    before() - Inserts content before the selected elements

</h1>
<br><br>
<p>This is a paragraph.</p>
<p>This is another paragraph.</p>

<ol>
  <li>List item 1</li>
  <li>List item 2</li>
  <li>List item 3</li>
</ol>

<button id="btn1">Append text</button>
<button id="btn2">Append list items</button> <br>

<button id="btn3">Prepend text</button>
<button id="btn4">Prepend list items</button>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn1').click(function(){
			$('p').append('<b>Append text </b>')
		});

		$('#btn2').click(function(){
			$('ol').append('<li>Append itme </li>')
		});
	});
</script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#btn3').click(function(){
			$('p').prepend('<b>prepend text </b>')
		})

		$('#btn4').click(function(){
			$('ol').prepend('<li>prepend item </li>')
		})
	});
</script>	

</body>
</html>