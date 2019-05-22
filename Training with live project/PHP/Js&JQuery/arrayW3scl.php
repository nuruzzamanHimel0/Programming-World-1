<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<script type="text/javascript">
		
	var days = ['sun','mon','tus','wed','thus','fri'];

	// var days[0] = 'sat';
	// var days[1] = 'mon';
	// var days[2] = 'tus';
	
	var lengthh = days.length;
	document.write("Length:"+lengthh+"<br>");

	document.write("days: \n");
	for (var i = 0; i < days.length; i++) {
		document.write(days[i]+" ")
	}
	document.write("<br>");

	</script>


	<script type="text/javascript">
		var days = new Array('sun','mon','tus','wed','thus','fri');
		document.write("days: \n");
		for (var i = 0; i < days.length; i++) {
			document.write(days[i]+" ")
		}
		document.write("<br>");
	</script>

	<p id="demo"></p>
	<p id="demo1"></p> 
	<p id="demo2"></p>
	<p id="demo3"></p>
	<p id="demo4"></p>
	for loop:
	<p id="demo5"></p>

	<p id='assArray'></p>

	<script type="text/javascript">
		var cars = new Array("Saab", "Volvo", "BMW");
		// edited..
		cars[0] ='Opel';

		document.getElementById("demo").innerHTML  = cars;

		// document.write("<br>");
		document.getElementById('demo1').innerHTML = cars[0];

		// document.write("<br>");
		document.getElementById('demo2').innerHTML = cars;

		// Associative Array
		var person = {'fname':'Nuruzzaman','lname':'himel','age':26};

		document.getElementById('demo4').innerHTML = person['fname'];

		// The best way to loop through an array is using a standard for loop:
		var fruits, text, flen;

		fruits = ["Banana", "Orange", "Apple", "Mango"];

		flen = fruits.length;

		text = "<ul>";
		for(var i =0;i<flen;i++)
		{
			text += "<li>"+fruits[i]+"</li>";
		}
		text += "</ul>";

		document.getElementById("demo5").innerHTML = text+"<br>";

		//https://www.w3schools.com/js/js_arrays.asp
		

	</script>
	
	 <p> Array,forEach() calls a function for each array element  </p>
	<p id="demo6"></p>

	<script type="text/javascript">
		var fruits, text;
		fruits = ["Banana", "Orange", "Apple", "Mango"];

		text = "<ul>";
		fruits.forEach(myFunction);
		text +="</ul>";

		function myFunction(value)
		{
			text +="<li>"+value+"</li>";
		}

		document.getElementById("demo6").innerHTML =text;
	</script>

	<p>Adding Array Elements(array push): Array.push('data')</p>

	<div id="addarray1"></div>
	<div id="addarray2"></div>

	<button onclick="myFunction()">Try On</button>

	<script type="text/javascript">
		var fruits = ["Banana", "Orange", "Apple", "Mango"];

		document.getElementById('addarray1').innerHTML = fruits;

		function myFunction()
		{
			fruits.push('kela');
			document.getElementById('addarray2').innerHTML = fruits;
		}

	</script>

	<h2>Example 2:</h2>
	<button onclick="addArray()">Try it</button>

	<div id='addAry'></div>

	<script type="text/javascript">
		var fruits = ["Banana", "Orange", "Apple", "Mango"];

		document.getElementById('addAry').innerHTML = fruits;

		function addArray()
		{

			fruits[fruits.length] = 'abcd';
			document.getElementById('addAry').innerHTML = fruits;
		}

	</script>



</body>
</html>