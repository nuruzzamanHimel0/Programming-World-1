<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>SoftAOX | Insert Checkbox values in Database using Ajax, Jquery & PHP</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	</head>
	<body>
		<h3>Insert Checkbox values in Database using Ajax, Jquery in PHP</h3>
		<input type="checkbox" id="submit" class="get_value" value="Apple"><label>Apple</label><br/>
		<input type="checkbox" id="submit" class="get_value" value="IBM"><label>IBM</label><br/>
		<input type="checkbox" id="submit" class="get_value" value="Google"><label>Google</label><br/>
		<input type="checkbox" id="submit" class="get_value" value="Microsoft"><label>Microsoft</label><br/>
		<input type="checkbox" id="submit" class="get_value" value="Amazon"><label>Amazon</label><br/>
		<br/>
		<button type="button" name="submit" >Save</button>
		<br/>
		<h4 id="result"></h4>
		<script>
		$(document).ready(function(){
			$('.get_value').click(function(){
				var insert = [];
			$('.get_value').each(function(){
				if($(this).is(":checked"))
				{
				insert.push($(this).val());
				}
			});

				insert = insert.toString();

			$.ajax({
			url: "insert.php",
			method: "POST",
			data:{insertt:insert},
			dataType: 'text',
			success:function(data){
			$('#result').html(data);
			}
			});
		});

		});
		</script>
		
	</body>
</html>