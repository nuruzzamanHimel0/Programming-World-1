$(document).ready(function(){
	var code = $('.codemirror-textarea')[0];
	var editor = CodeMirror.fromTextArea(code,{
		lineNumbers:true,
		 mode: "css",
		 theme: 'isotope',
		 tabSize: 5
	});

	$("#preview-form").keyup(function(){
		var value = editor.getValue();
		if(value.length == 0)
		{
			alert("missing");
		}else{
			alert(value);
		}
	});



});