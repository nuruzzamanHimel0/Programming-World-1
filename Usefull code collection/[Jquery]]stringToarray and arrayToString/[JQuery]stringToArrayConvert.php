<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>`String to time</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

	<script type="text/javascript">
		
		$(document).ready(function(){
			$('#idbtn').click(function(){
				var txtstring = $("#idtxt").val();
				// alert(txtstring);
				var stringSplit = txtstring.split(',');

				for(i=0; i< stringSplit.length;i++)
				{
					alert(stringSplit[i]);
				}
			});
		});

	</script>
	
<input type="text" name="" id="idtxt" value="cse,eee,ete,it,civil,textile">
<input type="button" name="" id="idbtn" value="Button">


</body>
</html>