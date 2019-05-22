<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class 5</title>
</head>
<body>
	<!-- EXAMPLE: 1 ---------------------------------------------- -->
	<h1>Example 1: .......................................</h1>
	<input type="text" name="" placeholder="width" id="width"> <span id="ew" style="font-size: 18px; color: red;"></span> <br> 
	<input type="text" name="" placeholder="height" id="height"><span id="eh" style="font-size: 18px; color: red;"></span> <br>
	<input type="text" name="" placeholder="background" id="background"><span id="eb" style="font-size: 18px; color: red;"></span> <br>

	<button type="button" onclick="show()">Click Here</button>

	<div id="output"></div>

	<script type="text/javascript">
		
		function show()
		{
			var w = document.getElementById("width").value
			var h = document.getElementById("height").value;
			var b = document.getElementById("background").value;

			var o = document.getElementById("output");

			var error = 0;

			if(w == '' || isNaN(w))
			{
				error++;
				document.getElementById('ew').innerHTML = "Enter numeric width value";
			}
			else{
				document.getElementById('ew').innerHTML = "";
			}

			if(h =="" || isNaN(h))
			{
				error++;
					document.getElementById('eh').innerHTML = "Enter numeric hight value";
			}
			else{
				document.getElementById('eh').innerHTML = "";
			}

			if(b == "")
			{
				error++;
				document.getElementById('eb').innerHTML = "Enter background";
			}
			else{
				document.getElementById('eb').innerHTML = "";
			}
			if(error == 0)
			{
				o.style.width = w+"px";
			o.style.height = h+"px";
			o.style.background = b;
			}

			
		}
	</script>

	<br><hr><br>
	<h1>Example 2: ........................................</h1>

	<div id="dateMYTime"></div>

	<script type="text/javascript">
		var days = ['sun','mon','tus','wed','thu','fri','sat'];
		var months = ['jan','feb','mar','apri','may','jun','july','aug','sept','oct','nov','dec'];
		var o = document.getElementById("dateMYTime");

		var dt = new Date();
		var date = dt.getDate();
		var day = dt.getDay();
		var month = dt.getMonth();
		var fullYear = dt.getFullYear();

		var hours = dt.getHours();
		var minutes = dt.getMinutes();
		var sec = dt.getSeconds();


		o.innerHTML = date+" "+days[day]+" "+months[month]+" "+fullYear+" "+hours+":"+minutes+":"+sec;



	</script>

	<br><hr><br>
	<h1>Example 3(running clock: ........................................</h1>

	<div id="analogC"></div>

	<script type="text/javascript">
		
		

		function clock()
		{
			var o = document.getElementById("analogC");
			var dt = new Date();
		var hours = dt.getHours();
		var minutes = dt.getMinutes();
		var sec = dt.getSeconds();
		o.innerHTML =hours+":"+minutes+":"+sec;

		}

		setInterval(clock,1000);

	</script>

	<hr><hr><br><br>
	<h1>Digital LOCAK clock.....................</h1>

	<div id="dc"></div>
	 <button  onClick="stopTimesDigital()" ><p>Stop Time</p></button>	

	<script type="text/javascript">
		
		// Digital Clock....................................
		
		function timeStart()
		{
var a = document.querySelector("#dc");
		var dt = new Date();

		var t= dt.toLocaleTimeString();
		

		a.innerHTML = t;
		}
		
		var timeclock = setInterval(timeStart,1000);

		function stopTimesDigital(){
			clearInterval(timeclock);
		}
		
	</script>

	


</body>
</html>