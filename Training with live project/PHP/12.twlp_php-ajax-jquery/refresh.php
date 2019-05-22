<?php include 'inc/header.php'; ?>
<h2>Ajax:- Auto Refresh div content</h2>
<style type="text/css">
	.refresh{
		background: #00FFFF; 
		width: 230px;
		min-height: : 80px;
		margin-left: 50px;
		padding: 10px 20px;
	}
	.refresh ul{margin: 0px; padding: 0px; list-style: none;}
	.refresh ul li{padding: 10px 0px;}
	.refresh ul li a {
	text-decoration: none;
	display: block;
	width: 100%;
	padding: 4px;
}
.refresh ul li a:hover{background:#7FFF00; }
</style>
<div class="content">
	<form action="" method="post">
		<table>
			<tr>
				<td>Content</td>
				<td>:</td>
				<td>
					<textarea name="body" id="body"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<input type="submit" name="autosubmit" id="autosubmit" value="POST">
				</td>
			</tr>
		</table>
		<div id="userStatusRefresh"></div>
	</form>
</div>
 <?php include 'inc/footer.php'; ?>