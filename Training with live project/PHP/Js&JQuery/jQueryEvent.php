<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jquery Event</title>
</head>
<body>
<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>



<h1>click event.................................</h1><br>


<p>If you click on me, I will disappear.</p>
<p>Click me away!</p>
<p>Click me too!</p>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('p').click(function(){
			$(this).hide();
		});
	});
</script>
<br>

<h1>dblclick event.................................</h1><br>

<p id="dc">If you click on me, I will disappear.</p>
<p id="dc">Click me away!</p>
<p id="dc">Click me too!</p>

<!-- <script type="text/javascript">
	
	$(document).ready(function(){
	  $("#dc").dblclick(function(){
	    $("#dc").hide();
	  });
	});
</script> -->
<br>

<h1>mouseenter event.......................................</h1> <br>

<p id="me">Enter the paragraph</p>

<!-- <script type="text/javascript">
	
	$(document).ready(function(){
		$('#me').mouseenter(function(){
			alert("Hello Himel!! mouseenter event work");
		});
	});
</script> -->

<h1>mouseleave event.......................................</h1> <br>

<p id="ml">Mouseleave the paragraph</p>

<!-- <script type="text/javascript">
	
	$(document).ready(function(){
		$('#ml').mouseleave(function(){
			alert("Hello Himel!! mouseleave event work");
		});
	});
</script> -->

<h1>mousedown event.......................................</h1> <br>

<p id="md">mousedown the paragraph</p>

<!-- <script type="text/javascript">
	
	$(document).ready(function(){
		$('#md').mousedown(function(){
			alert("Hello Himel!! mousedown event work");
		});
	});
</script> -->

<h1>mouseup event.......................................</h1> <br>

<p id="mu">mouseup the paragraph</p>
<!-- 
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#mu').mouseup(function(){
			alert("Hello Himel!! mouseup event work");
		});
	});
</script> -->

<h1>hover event.......................................</h1> <br>

<p id="ho">hover the paragraph</p>

<script type="text/javascript">
	
	// $(document).ready(function(){
	// 	$('#ho').hover(function(){
	// 		alert('You enter P1')
	// 	},function(){
	// 		alert("Bye! You now leave p1!");
	// 	});
	// });
</script>

<h1>focus and blur event..................................</h1> <br>

Name:<input type="text" name="" class="fb"><br>
email:<input type="text" name="" class="fb">

<script type="text/javascript">
	
	$(document).ready(function(){
		$('input.fb').focus(function(){
			$(this).css('background-color','#DC143C');
			$(this).css('border-radius','5px');
			$(this).css('width','500px');
			$(this).css('padding','20px');
		});

		$('input.fb').blur(function(){
			$(this).css('background-color','#0000FF');

		});
	});
</script>

<h1>mouseenter, mouseleave and click in only 'on' event event in same sile.................</h1> <br>

<p id="mul">Click or move the mouse pointer over this paragraph.</p>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#mul').on('mouseenter',function(){
			$(this).css("background-color", "lightgray");
		});

		$('#mul').on('mouseleave',function(){
			$(this).css("background-color", "lightblue");
		});

		$('#mul').on('click',function(){
			$(this).css("background-color", "yellow");
		});
	});
</script>

			



	
</body>
</html>