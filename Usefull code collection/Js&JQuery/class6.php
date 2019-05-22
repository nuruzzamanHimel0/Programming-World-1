<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class - 6</title>
</head>
<body>

<h1>Visibility/Hidden:.....................</h1>	
<br>
	<p id="para">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

<button onclick="hide()" id='hide'>Hide Button</button>
<button onclick="show()" id='show' style="visibility: hidden;">Show Button</button>
<button onclick="toggle()">Toggle</button>

<script type="text/javascript">
	
	function hide()
	{
		var p = document.getElementById("para");
		var h = document.getElementById("hide");
		var s = document.getElementById("show");

	

		p.style.visibility = 'hidden';
		h.style.visibility = 'hidden';
		s.style.visibility =  'visible';

		
	}

	function show()
	{
		var p = document.getElementById("para");
		var h = document.getElementById("hide");
		var s = document.getElementById("show");

		p.style.visibility = 'visible';
		h.style.visibility = 'visible';
		s.style.visibility =  'hidden';
	}
	function toggle()
	{
		var p = document.querySelector('#para');
		var h = document.querySelector("#hide");
		var s = document.querySelector("#show");

		if(p.style.visibility == 'hidden')
		{
			p.style.visibility = 'visible';
			h.style.visibility = 'visible';
			s.style.visibility = 'hidden;'
		}
		else{
			p.style.visibility = 'hidden';
			s.style.visibility = 'visible;'
			h.style.visibility = 'hidden';
		}
	}
</script>

<br> <br> <h1>BOX MOVE:..................</h1><br>
<!-- Two function for use clock or recursive function that is:
1) setIntervel(function,time) and clearIntervel(var)
2) setTimeout(function,time) and clearTimeout(var) -->

	<div id="box" style="height: 100px;width: 100px;background: red;"></div>

	<script type="text/javascript">
		var x = 0;
		var posX = 1;
		function rotate()
		{
			x = x+posX;
			var b= document.getElementById('box');

			b.style.transform = "rotate("+ x +"deg)";
			b.style.marginLeft = x+"px";

			if(x>300)
			{
				posX = -1;
			}
			else if(x<0){
				posX = 1;
			}


			setTimeout(rotate,10); // setTimeout. setIntervel

		}

		rotate();

	</script>
	<br><br><h1>Buld toggle without button:..........</h1><br>
	<img src="image/pic_bulboff.gif" width="100" height="180" onclick="touchBulb()" id="myImage">

<script type="text/javascript">
	
	function touchBulb()
	{
		var image = document.querySelector("#myImage");

		if(image.src.match('bulbon'))
		{
			image.src = 'image/pic_bulboff.gif';
		}
		else{
			image.src = 'image/pic_bulbon.gif';

		}

	}
</script>

	</script>
	<br><br><h1>Buld on of and toggle with button:..........</h1><br>
	<img src="image/pic_bulboff.gif" width="100" height="180" onclick="touchBulb()" id="blbImg">

	<button onclick="onBulb()">ON BULB</button>
	<button onclick="offBulb()">OFF BULB</button>
	<button onclick="toggleBulb()">TOGGLE BULB</button>

	<script type="text/javascript">
		function onBulb()
		{
			var image = document.getElementById('blbImg');
			
			image.src = 'image/pic_bulbon.gif';
		}
			function offBulb()
		{
			var image = document.getElementById('blbImg');
			
			image.src = 'image/pic_bulboff.gif';
		}
		function toggleBulb()
		{
			var image = document.getElementById('blbImg');

			if(image.src.match('pic_bulboff'))
			{
				image.src = 'image/pic_bulbon.gif';
			}
			else{
				image.src = 'image/pic_bulboff.gif';
			}

		}
	</script>


	<br><br><br>

	


</body>
</html>