$(document).ready(function(){
	var offset = 0;
	var rows = 20;
	var contentHeight = $(window).height();

	loadContent($('.container'),offset,rows);
	offset = offset+rows;

	$(window).scroll(function(){
		var scrTop = Math.round($(window).scrollTop());

		if(scrTop > contentHeight)
		{
			loadContent($('.container'),offset,rows);
			offset = offset+rows;
			contentHeight += $(window).height();
			console.log(scrTop+" -- "+contentHeight);
		}



	

});


function loadContent(container,offset,rows)
{
	$.ajax({
		url:"check/data.php",
		method:"POST",
		data:{offset:offset,rows:rows},
		dataType:'text',
		success:function(reflection)
		{
			container.append(reflection);
		}
	});
	return false;
}