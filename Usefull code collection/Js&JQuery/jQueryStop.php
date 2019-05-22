<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		#pannel, #flip {
	background: #6EFB91;
	padding: 10px;
	border: 1px solid #ddd;
	text-align: center;
	font-size: 20px;
}
		#pannel{
			padding: 80px;
			display: none;

		}

		#stopToggle{
			border: 2px solid #ddd; 
			background: #ddd; 
			width: 130px;
			height: 50px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>

	<script type="text/javascript" src="JS/jQuery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<button id="stopToggle">Stop Toggle</button>

	<div id="flip">Press Slide for  toggle</div>
	<div id="pannel">Helllow world</div>

	

	<script type="text/javascript">
		
		$(document).ready(function(){
			$('#flip').click(function(){
				$('#pannel').slideToggle(2000);
			});

			$('#stopToggle').click(function(){
				$('#pannel').stop()
			});

		});
	</script>
	
</body>
</html>