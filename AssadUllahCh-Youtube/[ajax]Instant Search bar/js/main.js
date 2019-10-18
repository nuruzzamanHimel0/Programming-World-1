$(document).ready(function(){
	
	$('#q').keyup(function(){

		q = $(this).val();
		// console.log(q);

		if(q !== "" && q !== null)
		{
			$.ajax({
				url: "check/checkSuggestion.php",
				method: 'POST',
				data:{q:q},
				dataType:"text",
				success:function(reflection)
				{
					if($.trim(reflection) != " ")
					{
						
						console.log(reflection);
					$('#resultId').html(reflection);
					}

					
				},
				error:function(reflection)
				{
					console.log(reflection);
				}
			});
		}else{
			$('#resultId').html(" ");
		}

	});
});