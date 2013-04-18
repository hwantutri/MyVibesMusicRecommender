<div class='row'>
	<div class="span3" style="margin-left:14%; margin-top:5%;"'>
	<div class="prof-pic">
		<form class="form-profile">
			<center><img src="<?php 
					$path = 'img/profile/' . $_GET['username'] .'.jpg'; 
					
					if (file_exists($path)) {
						echo $path;
					} else {
						echo 'img/profile/default.jpg';
					}
				 ?>" width="150px" class="img-polaroid"/></center>
		</form>
	</div></div>

		<div class="span3" style='margin-left:14%; margin-top:5%;'>
		<table class='table'>
		<tbody>
			<tr class="prof-info">
				<strong><?php echo $row8; ?></strong>
			</tr>
				<tr class='description font'>
				<?php echo $row9; ?>
				</tr>
				<tr class='status font'>
				<?php echo $row10;?>
				</tr> 
				<tr class='website font'>
				<?php echo $row30; ?>
				</tr> 

				<form name="addfriend" method="post" action="add-friend.php">
				<input type="hidden" name="usename" id="usename" value="<?php echo $_GET['username'] ?>" />
				<?php echo $results5; ?>
				</form>
		</tbody>
		</table>
		</div>
</div>