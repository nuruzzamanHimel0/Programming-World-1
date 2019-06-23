<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Editor</title>
  <style type="text/css" media="screen">
    body {
        overflow: hidden;
    }
    #editor {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 600px;
        height: 200px;
    }
  </style>
</head>
<body>

<pre id="editor"></pre>

<!-- <textarea id='ed'></textarea> -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="show_result"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!-- <script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script> -->
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js'></script>
<script>
   

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
     var editor = ace.edit("editor");
    editor.setTheme("ace/theme/cobalt");
    editor.session.setMode("ace/mode/javascript");

      $('#editor').keydown(function(){
         var code = editor.getValue();
         // alert(code);
          $('#show_result').text(code);
      });
  });
</script>

</body>
</html>




<!-- EDITOR CONFIGARATION........................................................................................................................................................................................ -->
<!-- 
1)stackoverflow LINK:https://stackoverflow.com/questions/8963855/how-do-i-get-value-from-ace-editor
2)THEME CHANGE LINK:https://ace.c9.io/build/kitchen-sink.html
3)GIT LINK:https://github.com/ajaxorg/ace/blob/master/build_support/editor.html -->

<!-- Per their API:

  CDN LINK IS HERE:https://cdnjs.com/libraries/ace/

Markup:

<div id="aceEditor" style="height: 500px; width: 500px">some text</div>

Finding an instance:

var editor = ace.edit("aceEditor");

Getting/Setting Values:

var code = editor.getValue();

editor.setValue("new code here"); -->


<!--CHECK "#editor" ID EXIST OR NOT then get ace.edit())........................
Example:
 var $editor = $('#editor');
    if ($editor.length > 0) {
        var editor = ace.edit('editor');
        editor.session.setMode("ace/mode/css");
        $editor.closest('form').submit(function() {
            var code = editor.getValue();
            $editor.prev('input[type=hidden]').val(code);                
        });
    }; -->