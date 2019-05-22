<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Class 4(JS GRAPH)</title>
</head>
<body>
	
	<p>Type change:-----------------</p>
	<input type="text" name="" id="demo1"> <br>
	<input type="submit" name="" onclick="myFunction()" > <br> <br>
	<input type="text" name="" id="demo2"> <br>

	<script type="text/javascript">
		
		

		function myFunction()
		{
			var i = document.querySelector('#demo1');
			var o = document.querySelector("#demo2");

			 i = i.value;

			 o.type = i;
		}

	</script>
	<br><br><hr><hr><br><br>

	<p>background color change</p>
	<input type="text" name="" id="bg1"> <br>
	<input type="submit" name="" onclick="bgFunction()"> <br>
	<textarea cols="30" rows="10" id="bg2" > 
		
	</textarea><br>

	<script type="text/javascript">
		
		function bgFunction()
		{
			var bgi = document.querySelector("#bg1");
			var bgo = document.querySelector('#bg2');

			bgi = bgi.value;
			// document.write(bgi);
			bgo.style.background = bgi;
		}
	</script>
	<br><br><hr><hr><br><br>

	<p>SUm of two number:</p>

	<input type="number" name="" id="num1"><br>
	<input type="number" name="" id="num2"><br>
	<input type="submit" name="" onclick="sumFunction()"> <br>
	<input type="text" name="" id="sum">
	</textarea><br>

	<script type="text/javascript">
	
	function sumFunction()
	{

		var num1 = document.querySelector('#num1').value;
		var num2 = document.querySelector('#num2').value;

		num1 = Number(num1);
		num2 = Number(num2);

		var sumNum = Number(num1+num2);
		// document.write(sumNum);

		document.querySelector('#sum').value = sumNum;
	}

	</script>


</body>
</html>