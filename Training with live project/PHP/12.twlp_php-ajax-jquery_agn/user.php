<?php include 'inc/header.php'; ?>
<h2>Ajax:- Check username availability</h2>
<div class="content">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" id="username" placeholder="Enter Your Username...">
				</td>
			</tr>
		</table>
		<div id="userStatus"></div>
	</form>
</div>
 <?php include 'inc/footer.php'; ?>