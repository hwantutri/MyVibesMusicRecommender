<?php include "includes/sql_stata.php";?>
<div class="span1">
	<form class="form-profile">
		<div class="prof-pic">
		<img src="<?php 
					$path = 'img/profile/' . $_SESSION['username'] .'.jpg'; 
					
					if (file_exists($path)) {
						echo $path;
					} else {
						echo 'img/profile/default.jpg';
					}
				 ?>" 
		width="100px" class="img-polaroid"/></div>
	</form>
	<!--img/profile/ echo $_SESSION['username'];-->
</div>
	<div class='span2 adjustment1'>
		<div class="prof-name" style="margin-left:5px">
			<strong><?php 
				echo $row2;
				?></strong>
		</div>
		<div class='links' id="freq">
			<a href="friendreq.php"><strong>Friend Requests (<?php echo $results6; ?>)</strong></a>
		</div>
		<div class='links'>
			<i class="icon-headphones" style='margin-right:5px'></i><strong>Playlist</strong>
		</div>
	</div>