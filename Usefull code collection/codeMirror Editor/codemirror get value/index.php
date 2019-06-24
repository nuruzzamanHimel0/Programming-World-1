youtube linke playlist: https://www.youtube.com/watch?v=arRXx4s7o8Q&t=338s
youtube link(get value of CodeMirror text editor ):https://www.youtube.com/watch?v=MwNgPOmOxW0&t=5s
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>codemirror</title>
	<style type="text/css">
		.codemirror-textarea{
			width: 100%;
			height: 600px;
		}
	</style>
	<!-- .....commont link..................... -->
	<link rel="stylesheet" type="text/css" href="plagin/codemirror/lib/codemirror.css">
	<!-- add diffeteret theme theme............ -->
	<link rel="stylesheet" type="text/css" href="plagin/codemirror/theme/cobalt.css">
	<link rel="stylesheet" type="text/css" href="plagin/codemirror/theme/isotope.css">

	<!-- .................auto complete.............................. -->
	<link rel="stylesheet" type="text/css" href="plagin/codemirror/addon/hint/show-hint.css">
</head>
<body>
<?php 
$comment = null;
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit']))
	{
		$comment = trim($_POST['privew-from-comment']);
		 
	}
?>

<form id="preview-form" method="post" action="">

	<textarea class="codemirror-textarea" name="privew-from-comment" id="privew-form-comment">
		<?php echo trim($comment); ?>
	</textarea>
	<br><br>

	<input type="submit" name="submit" value="Submit" id="privew-submit">

</form>
<div id="preview-comment"><?php echo $comment; ?></div>























	
<!-- ..............common link.................. -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="plagin/codemirror/lib/codemirror.js"></script>
	<!-- add Diffetent mode............................... -->
	<script type="text/javascript" src="plagin/codemirror/mode/css/css.js"></script>
	<script type="text/javascript" src="plagin/codemirror/mode/apl/apl.js"></script>
	<script type="text/javascript" src="plagin/codemirror/mode/apl/apl.js"></script>

	<!-- .................auto complete.............................. -->
	<script type="text/javascript" src="plagin/codemirror/addon/hint/show-hint.js"></script>
	<script type="text/javascript" src="plagin/codemirror/addon/hint/css-hint.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>