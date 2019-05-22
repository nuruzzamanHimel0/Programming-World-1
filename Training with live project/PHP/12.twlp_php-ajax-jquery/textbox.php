<?php include 'inc/header.php'; ?>
<h2>Ajax:- Autocomplete textbox</h2>
<style type="text/css">
	.skill{
		background: #00FFFF; 
		width: 230px;
		min-height: : 80px;
		margin-left: 50px;
		padding: 10px 20px;
	}
	.skill ul{margin: 0px; padding: 0px; list-style: none;}
	.skill ul li{padding: 10px 0px;}
	.skill ul li a {
	text-decoration: none;
	display: block;
	width: 100%;
	padding: 4px;
}
.skill ul li a:hover{background:#7FFF00; }
</style>
<div class="content">
	<form action="" method="post">
		<table>
			<tr>
				<td>Skill</td>
				<td>:</td>
				<td>
					<input type="text" name="skill" id="skill" placeholder="Enter Your Skill...">
				</td>
			</tr>
		</table>
		<div id="userStatusSkil"></div>
	</form>
</div>
 <?php include 'inc/footer.php'; ?>