<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Js ALL Event</title>
</head>
<body onload="loadfunction()">

	<script type="text/javascript">
	alert("Welcome to Javascript Event Word. Here i explain all event if JS. Such as, onload,onkeydown,onkeyup,onmousemover,onmouseout,onmousemove,onmouseup,onmousedown,onchange")
	</script>

	<h1>onkeydown event......................</h1>
	<br>
	<input type="text" name="" onkeydown="keydown()" id="kdtext">
	<div id="kdout"></div>

	<script type="text/javascript">
		
		function keydown()
		{
			var i = document.querySelector('#kdtext').value;
			var o = document.querySelector('#kdout');

			o.innerHTML = i;

		}
	</script>
	<br><br><h1>onkeyup event</h1>
	<br>

	<input type="text" name="" onkeyup="keyup()" id="kutext">
	<div id="kuout"></div>

	<script type="text/javascript">
		
		function keyup()
		{
			var i = document.querySelector('#kutext').value;
			var o = document.querySelector('#kuout');

			o.innerHTML = i;

		}
	</script>

	<br><br><h1>onmouseover/onmouseout event..............</h1>
	<br>
	<img src="image/pic_bulbon.gif" width="100px" height="200px;" onmouseover="bigImg()" onmouseout="smallImg(this)" id="bgimg">

	<script type="text/javascript">
		
		function bigImg()
		{
			var i = document.querySelector('#bgimg');

			i.style.width = '300px';
			i.style.height = '400px';
		}

		function smallImg(x)
		{
			x.style.width = '100px';
			x.style.height = '200px';
		}

	</script>

	<br><br><h1>onmousemove event.......................</h1>
	<br>
	
	<style type="text/css">
		.boxdiv{
			width: 300px;height:150px; border: 3px solid black;
		}
	</style>
	<div class="boxdiv" onmousemove="movemousefun(event)" onmouseout="mouseoutfunc()"></div>
	<div id="boxdivout"></div>

	<script type="text/javascript">
	
	function movemousefun(e)
	{
		var x = e.clientX;
		var y = e.clientY;

		var coor = "Coordiates:("+x+","+y+")";
		document.querySelector('#boxdivout').innerHTML = coor;
	}	

	function mouseoutfunc()
	{
		document.querySelector('#boxdivout').innerHTML = "";
	}

	</script>

	<br><br><h1>onmouseup and onmousedown event....................</h1>
	<br>

	<p id="myPr" onmouseup="mouseupfunc()" onmousedown="mousedownfunc()">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<script type="text/javascript">
		
		function mousedownfunc()
		{
			document.getElementById('myPr').style.color = 'red';
		}

		function mouseupfunc()
		{
			document.getElementById('myPr').style.color = 'green';
		}
	</script>
<br><br><h1>onchange event....................................</h1>
<br>

<select id="mySelect" onchange ="changeFunc()">
	<option value="AAA">AAA</option>
	<option value="BBB">BBB</option>
	<option value="CCC">CCC</option>
	<option value="DDD">DDD</option>
</select>

<div id="divChang"></div>

<script type="text/javascript">
	
	function changeFunc()
	{
		var i = document.getElementById("mySelect").value;

		document.getElementById('divChang').innerHTML = i ;
	}
</script>





	<br><br><br>
	
</body>
</html>