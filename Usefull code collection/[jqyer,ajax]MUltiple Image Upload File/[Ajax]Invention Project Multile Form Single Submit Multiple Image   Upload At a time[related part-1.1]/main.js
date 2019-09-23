window.imgFormate = [];


// ............................ outgoing image upload..............................

function OutgoingPictureUpload(pic_id,filename,camp_id,endingComand)
{


var form_data = new FormData();

if(endingComand === "NOT_FINISH")
{
	var ins = document.getElementById(pic_id).files;
	for(var i=0; i < ins.length; i++)
	{
		form_data.append(filename,document.getElementById(pic_id).files[i]);
	}


	form_data.append('camp_Id',camp_id);
	form_data.append('pic_ID',pic_id);
	form_data.append('FileName',filename);
	form_data.append('EndingComand',endingComand);
}
else{
	form_data.append('FileName',"no_file here");
	form_data.append('EndingComand',endingComand);
}


	$.ajax({
		url:"checkAjax/outgoing_image_upload.php",
		method:"post",
		data:form_data,
		dataType:'text',
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success:function(reflection)
		{
			// console.log(reflection);
			if(reflection != 'FINISH' && reflection != 'Extension_not_exist')
			{
			console.log(reflection);
			imgFormate = false;

			}
			else if(reflection == 'Extension_not_exist')
			{
				imgFormate = true;
			}
			else if(reflection == "FINISH")
			{
				console.log(reflection);
				setInterval(function(){
				location.reload();	
			},4000);
				// location.reload();
			}


		}

	});

	 if (imgFormate == true) {
       return false; 
      // console.log(imgFormate);
        
    }
    else{
    	return true;
    }

	// return imgFormate;
}
 // ..................... Outgoing Pictures  ..................................

 $('#img_save').on('click',function(){

 	var counter = 0;
 	var output = true;
 	
	$('#img_save').hide();			
	$('#img_loading').show();			

 	if(output == true)
 	{

 		var filesP1 = document.getElementById("p1").files;
	 	if(filesP1.length > 0)
	 	{

				var pic_id = $('#p1').attr('id'); //p1
				var filename = $('#p1').attr('name'); //filesP1[]
				
				 output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');

				if(output === false)
				{
					console.log('retrun error responce p1');
					$('#img_error_noti').show('slow');
					//imgFormate = [ ];
				}

	 	}

 	}

 	if(output == true)
 	{
 		var filesP2 = document.getElementById("p2").files;
	 	if(filesP2.length > 0)
	 	{
	 		
			var pic_id = $('#p2').attr('id'); //p1
			var filename = $('#p2').attr('name'); //filesP1[]
			
			var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');

			if(output === false)
			{
				console.log('retrun error responce p2');
				$('#img_error_noti').show('slow');
				//imgFormate = [ ];
			}
			
	 	}

 	}

 	
if(output == true)
{
 	var filesP3 = document.getElementById("p3").files;
 	if(filesP3.length > 0)
 	{
 		
		var pic_id = $('#p3').attr('id'); //p1
		var filename = $('#p3').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p3');
			$('#img_error_noti').show('slow');
		}
 	}
 }

if(output == true)
{

 	var filesP4 = document.getElementById("p4").files;
 	if(filesP4.length > 0)
 	{
 		
		var pic_id = $('#p4').attr('id'); //p1
		var filename = $('#p4').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p4');
			$('#img_error_noti').show('slow');
		}
 	}
 }	
 

if(output == true)
{

 	var filesP5 = document.getElementById("p5").files;
 	if(filesP5.length > 0)
 	{
 		
		var pic_id = $('#p5').attr('id'); //p1
		var filename = $('#p5').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p5');
			$('#img_error_noti').show('slow');
		}
 	}
 }	


if(output == true)
{
 	var filesP6 = document.getElementById("p6").files;
 	if(filesP6.length > 0)
 	{
 		
		var pic_id = $('#p6').attr('id'); //p1
		var filename = $('#p6').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p6');
			$('#img_error_noti').show('slow');
		}
 	}


} 	


if(output == true)
{

 	var filesP7 = document.getElementById("p7").files;
 	if(filesP7.length > 0)
 	{
 		
		var pic_id = $('#p7').attr('id'); //p1
		var filename = $('#p7').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p7');
			$('#img_error_noti').show('slow');
		}
 	}

} 	

if(output == true)
{
 	var filesP8 = document.getElementById("p8").files;
 	if(filesP8.length > 0)
 	{
 		
		var pic_id = $('#p8').attr('id'); //p1
		var filename = $('#p8').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p8');
			$('#img_error_noti').show('slow');
		}
 	}
 }	


if(output == true)
{
 	var filesP9 = document.getElementById("p9").files;
 	if(filesP9.length > 0)
 	{
 		
		var pic_id = $('#p9').attr('id'); //p1
		var filename = $('#p9').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p9');
			$('#img_error_noti').show('slow');
		}
 	}

 }	

 if(output == true)
{
 
 	
 	var filesP10 = document.getElementById("p10").files;
 	if(filesP10.length > 0)
 	{
 		
		var pic_id = $('#p10').attr('id'); //p1
		var filename = $('#p10').attr('name'); //filesP1[]
		
		var output = OutgoingPictureUpload(pic_id,filename,camp_id,'NOT_FINISH');
		if(output === false)
		{
			console.log('retrun error responce p10');
			$('#img_error_noti').show('slow');
		}
 	}

 }	
 	

if(output == true)
{
	OutgoingPictureUpload(" "," "," ",'FINISH');
}
 

 });


