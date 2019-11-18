<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
</head>
<body>
		<form>
			<input type="text" name="" id="datepicker" placeholder="dd-mm-yy">
		</form>

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#datepicker').datepicker({
					dateFormat:"dd-mm-yy",
					changeMonth:true,
					changeYear:true
				});
			});
		</script>
</body>
</html>