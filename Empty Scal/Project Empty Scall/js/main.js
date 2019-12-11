// USERNAME ...........................................

$(document).ready(function(){
	$('#username').blur(function(){
		var username = $(this).val();

		$.ajax({
			url: "check/checkuser.php",
			method:"POST",
			data: {username:username},
			dataType :"text",
			success:function(reflection)
			{
				$('#userStatus').html(reflection);
			}
		});
	});


// TEXTBOX.............................................

	$('#skill').keyup(function(){
		var skill = $(this).val();

		if(skill != '')
		{
			$.ajax({
			url:"check/checkSkill.php" ,
			method: 'POST',
			data:{skill:skill},
			dataType:'text',
			success:function(reflection)
			{
				$('#userStatusSkil').fadeIn('slow');
				$('#userStatusSkil').html(reflection);
			}
		});

		}
		else{
			$("#userStatusSkil").text(" ");
		}
	});
// if press any result then fadeout
	$(document).on('click','li',function(){
		var lst = $(this).text();
		$('#skill').val(lst);
		$('#userStatusSkil').fadeOut();
	});

// 3.PASSWORD SHOW AND HIDE BUTTON..............................

	$("#buttonSH").click(function(){
		var btnType = $('#password').attr('type');

		if(btnType == 'password')
		{
			$('#password').attr('type','text');
			$('#buttonSH').text('Hide Password');
		}
		else
		{
			$('#password').attr('type','password');
			$('#buttonSH').text('Show Password');
		}
	});

	// 4. auto Refresh div content

	$("#autosubmit").click(function(){
		var content = $('#body').val();

		if($.trim(content) != '')
		{
			$.ajax({
			url:"check/checkRefresh.php",
			method:"POST",
			data:{content:content},
			dataType:"text",
			success:function(data)
			{
				//reflection................
				$("#body").val(" ");
			}
		});
			// return false;
		}



	});
// Auto Refresh div content(with out ajax reflection is here.....)
	setInterval(function(){
		$("#userStatusRefresh").load("check/getRefresh.php").fadeIn('8000')
	},1000)


	// 5. Ajax:- Live Data Search....................

	$('#livesearch').keyup(function(){
		var search = $(this).val();

		if(search != '')
		{
			$.ajax({
				url:"check/checkLiveSearch.php",
				method: "POST",
				data:{search:search},
				dataType:"text",
				success:function(reflection)
				{
					// responce...........
					$("#userStatusLive").fadeIn("slow");
					$("#userStatusLive").html(reflection);

				}
			});
			// return false;
		}
		else{
			$('#userStatusLive').text(" ");
		}

	});


	// Ajax:- AUto save data

	function autosave()
	{
		var content = $("#content").val();
		var contentId = $("#contentId").val();

		if(content != " ")
		{
			$.ajax({
				url:"check/checkAutoSave.php",
				method:"POST",
				data:{content:content,contentId:contentId},
				dataType:'text',
				success:function(reflection)
				{
					if(reflection != '' && $.isNumeric(reflection) )
					{
						$('#contentId').val(reflection); // contectId Insert
						$("#statusSave").text("Content save as Draft");
					}else{
						$("#statusSave").text(reflection);
					}



					setInterval(function(){
						$("#statusSave").text("");
					},3000);

				}
			});
		}
	}

	setInterval(function(){autosave() },10000);



});
