<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<form>
		 <select class="form-control" id="select_voicemail">

                                            <option value="male-speech" >Generic Male </option>

                                            <option value="female-speech">Generic Female</option>
                                            
                                        </select>

                                        <div id="show_result"></div>
	</form>

		<button id="ch">Click Here</button>






	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		
$(document).ready(function(){
// One way to select  option value

		$("#select_voicemail option").each(function(){
		$(this).click(function(){
			if($(this).is(':selected'))
			{
				var opt = $(this).val();
				alert(opt);
				$('#show_result').text(opt);
			}
		});
	});

// Anpther way to get option value...... that way is so easier.....................................................................................................................
	$('#select_voicemail').on('change', function() {
  var value = $(this).val();
  alert(value);
});



});

	</script>
</body>
</html>