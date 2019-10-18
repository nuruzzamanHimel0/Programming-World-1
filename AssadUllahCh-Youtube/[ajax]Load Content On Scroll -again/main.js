$(document).ready(function(){
	// alert("Hello Himel");
	var offset = 0;
	var rows = 20;
	var contentHeight = $(window).height();
	loadContent($('.container'),offset,rows);
	offset += rows;

	$(window).scroll(function(){
		var yOffset = Math.round($(window).scrollTop());

		if(yOffset>contentHeight)
		{
			loadContent($('.container'),offset,rows);
			offset += rows;
			contentHeight += $(window).height();

		}

		console.log(yOffset+"---"+contentHeight);
	});

	// console.log(contentHeight);
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
			// console.log(reflection);
		}
	});
}