 $(document).ready(function(){
	// alert('hello world');
	$('.questions').on('click',function(e){
		e.preventDefault(); // prevent the load page
		var icon = e.target;
		var id = $(icon).parent('a').attr('data-id');

		if( $(icon).hasClass("fa fa-thumbs-up") )
		{
			// if thumbs up icon get click
			updateAction(id,'like_opt',$(icon));
		}
		else if( $(icon).hasClass("fa fa-thumbs-down") )
		{
			// if thumbs down icon get click
			updateAction(id,'dislike_opt',$(icon));
		}

		// console.log(id);
	});
})

function updateAction(id,action,element)
{
	var $parent = element.parents("div.footer-icon");
	// console.log($parent);
	$.ajax({
		url:"check/checkupdate.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:'text',
		success:function(reflection)
		{
			reflection = $.parseJSON(reflection); // JSON Decode
			if(reflection.status == 'success')
			{
				$parent.html(reflection.html_fetch);
			}
			console.log(reflection.html_fetch);
			// console.log(reflection);
		}
	});
	return false;
}