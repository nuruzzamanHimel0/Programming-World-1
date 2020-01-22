$(document).ready(function(){

  $(document).on('keyup','#gsearchsimple',function(e){

    e.preventDefault();

    var query = $(this).val();
    $('#detail').html('');
    $('.list-group').css('display','block');

    if(query.length >= 1)
    {
    	$.ajax({
    		url:"check/fetch.php", //fetch_data($query)
    		method:"POST",
    		data:{query:query},
    		dataType:'text',
    		success:function(reflection)
    		{
                if($.trim(reflection) != "")
                {
                    $('.list-group').html(reflection);
                }
    			// console.log(reflection);
    		}

    	});
    }

    if(query.length < 1)
    {
    	 $('.list-group').css('display','none');
    }

    // console.log(query);


  });

    $('#localSearchSimple').jsLocalSearch({
        "action": "Show",
        "html_search": true,
        "mark_text": "mark"
    });

    $(document).on('click','.gsearch',function(){

        var email = $(this).text();
        $('#gsearchsimple').val(email);
         $('.list-group').css('display','none');

         $.ajax({
            url:"check/fetch.php", //fetch_data($query)
            method:'POST',
            data:{email:email},
            dataType:"text",
            success:function(reflection)
            {
                $('#detail').html(reflection);
                // console.log(reflection);
            }
         });

        console.log(email);
    })



});