<?php include "includes/sql_stata.php"; ?>
<div class='row'>
	<div class="span3" style='margin-left:14%; margin-top:5%;'>
	<div class="prof-pic">
		<form class="form-profile">
			<center><img src="<?php 
					$path = 'img/profile/' . $_SESSION['username'] .'.jpg'; 
					
					if (file_exists($path)) {
						echo $path;
					} else {
						echo 'img/profile/default.jpg';
					}
				 ?>" width="150px" class="img-polaroid"/></center>
		</form></div>
	</div>
	
		<div class='span3' style='margin-left:14%; margin-top:5%;'>
		<table class='table'>
		<tbody>
			<tr class="prof-info">
				<strong><?php echo $row2; ?></strong>
			</tr>
				<tr class='description font'>
				<?php echo $row3; ?>
				</tr>
				<tr class='status font'>
				<?php echo $row4;?>
				</tr> 
				<tr class='website font'>
				<?php echo $row5; ?>
				</tr> 
				<div class="friends" style='padding:6px'>Friends: 
				<?php echo $row6;
				?>
				</div>
		</tbody>
		</table>
		</div>
	
</div>