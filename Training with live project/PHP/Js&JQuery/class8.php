<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class 8</title>
</head>
<body>

	<h1>JS HIDE p</h1>
	<button type="button" id='hideb'  onclick="hideMe()">Hide FOR JS</button> <br>


	<button type="button" id="hidejq">Hide FOR JQuery</button> <br>
	<button type="button" id="showjq" style="visibility: hidden;">SHOW FOR JQuery</button> <br>
	<p id="hidep" style="visibility: visible;" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<br><br><br>
	<h2>2. Touch Paragraph and hide this paragraph..................</h2> <br>

	<p>If you click on me, I will disappear.</p>
	<p>Click me away!</p>
	<p>Click me too!</p>	




	<h2>3. SUM OF TWO NUMBERS...............................</h2>
	<input type="number" name="" id="a">
	<input type="number" name="" id="b">

	<div id="output"></div>
	<input type="submit" name="" id="sumBtn">

	<script type="text/javascript">
		
		function hideMe()
		{
			var h = document.querySelector('#hidep');
			var b = document.getElementById('hideb');
			var p = document.getElementById('hidep');

			b.style.display = 'none';
			h.style.display = 'none';
			p.style.display = 'none';

		}

	</script>


<script type="text/javascript" src="JS/jQuery.js"></script>

	<script type="text/javascript">
		
		// $(document).ready(function(){
		// 	$('#hidejq').click(function(){
		// 		$('p').hide();
		// 		$('#hidejq').hide();
		// 	});
		// });

		$(document).ready(function(){
			$('#hidejq').click(function(){
				var p = document.querySelector('#hidep');
				var hb = document.querySelector('#hidejq');
				var sb = document.querySelector('#showjq');

				p.style.visibility = 'hidden';
				hb.style.visibility = 'hidden';
				sb.style.visibility ='visible';


			});

			$('#showjq').click(function(){

				var p = document.querySelector('#hidep');
				var hb = document.querySelector('#hidejq');
				var sb = document.querySelector('#showjq');

				p.style.visibility = 'visible';
				hb.style.visibility = 'visible';
				sb.style.visibility ='hidden';
			});
		});

	</script>

	<!-- 2. Touch Paragraph and hide this paragraph.................. -->

	<script type="text/javascript">
		
		$(document).ready(function(){
			$('p').click(function(){
				$(this).hide();
			});
		});
	</script>

	<!-- 3. SUM OF TWO NUMBERS................................... -->

	<script type="text/javascript">
		
		$(document).ready(function(){
			

			$('#sumBtn').click(function(){
				var a1 = Number($("#a").val());
			var b1 = Number($("#b").val());

			var sum = a1+b1;
				$("#output").html(sum);
			})
		});
	</script>

	
</body>
</html>