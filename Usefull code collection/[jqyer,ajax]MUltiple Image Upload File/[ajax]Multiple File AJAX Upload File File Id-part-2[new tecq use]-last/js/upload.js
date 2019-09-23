var app = app || {};

(function(o){

	// console.log(o);

	// Private Methods............

	var ajax, getFormData, setProgress;

	ajax = function(data){

		var xmlhttp = new XMLHttpRequest(),uploaded;


		xmlhttp.addEventListener('readystatechange',function(){
			if(this.readyState === 4)
			{
				if(this.status == 200)
				{
					// console.log('Ok!!');

					// uploaded = JSON.parse(this.response);
					// console.log(uploaded);
				}
			}
		});

		xmlhttp.open('post', o.options.processor);
		xmlhttp.send(data);
	};

	getFormData = function(source){
		// console.log(source);

		var data = new FormData(),i;

		for (i = 0; i< source.length; i++) 
		{		
			data.append('file[]',source[i]);
		}

		data.append('ajax',true);

		return data;
	};

	setProgress = function(value){ 

	};

	o.uploader = function(options)
	{
		o.options = options;
		// console.log(o.options);

		if(o.options.files !== undefined)
		{
			ajax(getFormData(o.options.files.files));
			// console.log(o.options.files.files);
		}
	}


}(app));

