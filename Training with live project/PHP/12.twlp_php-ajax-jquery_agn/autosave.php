<?php include 'inc/header.php'; ?>
<h2>Ajax:- AUto save data</h2>

<div class="content">
	<form action="" method="post">
		<table>
			<tr>
				<td>Type Content</td>
				<td>:</td>
				<td>
					<textarea name="content" id="content">
						
					</textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<input type="hidden" name="contentId" id="contentId">
				</td>
			</tr>
		</table>
		<style type="text/css">
			#statusSave{color:blue;}
		</style>
		<div id="statusSave"></div>
	</form>
</div>
 <?php include 'inc/footer.php'; ?>