<?php include 'inc/header.php'; ?>
<h2>Ajax:- Create a new password Button</h2>

<div class="content">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username"  placeholder="Enter Your Username...">
				</td>
			</tr>

			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password" id="password"  placeholder="Enter Your password...">
				</td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td>
					<button type="button" name="buttonSH" id="buttonSH">Show Password</button>
				</td>
			</tr>
		</table>
		<div id="userStatusSkil"></div>
	</form>
</div>
 <?php include 'inc/footer.php'; ?>