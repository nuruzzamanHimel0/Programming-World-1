$(document).ready(function(){ 
  

  //01. Ajax:- Check username availability

	$("#username").blur(function(){

		var username = $(this).val();

		$.ajax({
			url: "check/checkuser.php",
			method:"POST",
			data: {username:username},
			dataType :"text",
			success:function(reflection)
			{
				if(reflection != ''){
					$('#userStatus').html(reflection);
				}
				
			}

		});
		
	});

// 	// TEXTBOX.............................................

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


	//Ajax:- Create a new password Button....................

	$("#buttonSH").click(function(){

		var type = $("#password").attr('type');

		if(type == 'password')
		{
			$('#password').attr('type','text');
			$('#buttonSH').text("Hid Password");
		}
		else{
			$('#password').attr('type','password');
			$('#buttonSH').text("Show Password");
		}
	});



	//Ajax:- Auto Refresh div content.....................

	$('#autosubmit').click(function(){

		var body = $('#body').val();

		if(body != " ")
		{
			$.ajax({
				url:"check/checkRefresh.php",
				method :"POST",
				data:{body:body},
				dataType:"text",
				success:function(reflection)
				{
					$("#body").val(" ");
				}
			});
		}
	});

	setInterval(function(){
		$('#userStatusRefresh').load('check/getRefresh.php').fadeIn("slow");
	});



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
				success:function(data)
				{
					// responce...........
					$("#userStatusLive").fadeIn("slow");
					$("#userStatusLive").html(data);

				}
			});
			return false;
		}
		else{
			$('#userStatusLive').text(" ");
		}

	});


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