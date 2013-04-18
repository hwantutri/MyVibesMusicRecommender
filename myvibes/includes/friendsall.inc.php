
	<form method="POST" action="friends.php#viewusers"> 
	<div class="friends-title">

	<input style='margin-right:1%;' type="text" name="tb1" onchange="submit()" class="input-medium search-query">Search</div>
	</form>
<hr>
<div class="row show-grid">
<div class="span6">
<?php

$friends ='';
			
 if(!empty($_REQUEST['tb1'])){		

			//<a href='add-friend.php?username=".$res->username."'>
			
				$n =0;
				while($n<count($data)){
				
					$row = (array)json_decode(json_encode($data[$n]));
						print "<div class='row show-grid'>";
						print "<div class='span4' style='width:240px'>";
						print "<div class='span1'>";
												
						echo "<div class='prof-pic'><img src='";
						$path = 'img/profile/' . $row['username'] .'.jpg'; 
						if (file_exists($path)) {
							echo $path;
						} else {
							echo 'img/profile/default.jpg';
						}
						echo "' width='100px' class='img-polaroid' /></div>";
						
						print "</div>";
						print "<div class='span2' style='width: 55%'>";
						print "<div class='prof-info adjustment1'>";
						print "<strong>";
						print "<a href='add-friend.php?username=".$row['username']."'>".$row['firstname']." ".$row['lastname']."</a> ";
						print "</strong>";
						print "</div>";
						print "<div class='description adjustment3 font1' style='word-wrap:break-word;'>";
						print "".$row['description']." ";
						print "</div>";
						print "</div>";
						print "</div>";
						
					$n++;
					
				}
				if(!$data){
				echo "No users on this system yet!";
				}
				//echo "<div class='pagination pagination-centered'>";
				//echo $page3;
				//echo "</div>";
		}
else{		

			//<a href='add-friend.php?username=".$res->username."'>
			
				$n =0;
				while($n<count($result)){
				
					$row = (array)json_decode(json_encode($result[$n]));
						print "<div class='row' style='margin-left:5%'>";
						print "<div class='span1' style='width:10%; min-height:10%'>";		
						echo "<div class='prof-pic'><img src='";
						$path = 'img/profile/' . $row['username'] .'.jpg'; 
						if (file_exists($path)) {
							echo $path;
						} else {
							echo 'img/profile/default.jpg';
						}
						echo "' width='100px' class='img-polaroid' /></div>";
						print "</div>";
						print "<div class='span4'>";
						print "<div class='prof-info adjustment2'>";
						print "<strong>";
						print "<a href='add-friend.php?username=".$row['username']."'>".$row['firstname']." ".$row['lastname']."</a> ";
						print "</strong>";
						print "</div>";
						print "<div class='description font1' style='word-wrap:break-word;'>";
						print "".$row['description']." ";
						print "</div>";
						print "</div>";
						print "</div>";
						
					$n++;
					
				}
				if(!$result){
				echo "No users on this system yet!";
				}
				//echo "<br/>";
				//echo "<div class='pagination pagination-centered'>";
				//echo $page11;
				//echo "</div>";

	}
	


?>
<!--
<div class="row">
	<div class="span3" style='width:240px'>
		<div class="span1">
			
				<div class="prof-pic"><img src="img/140x140.gif" width="100px" class="img-polaroid"></div>
		
		</div>
		<div class='span2'>
		<div class='prof-info adjustment2'>
			<strong>Aiko Katherine Olaer</strong>
		</div>
		<div class='description font1'>Username</div>
	</div>
	</div>

	<div class="span3" style='width:240px;'>
		<div class="span1">
			
				<div class="prof-pic"><img src="img/140x140.gif" width="100px" class="img-polaroid"></div>
		
		</div>
		<div class='span2'>
		<div class='prof-info adjustment2'>
			<strong>Genesis Bacarrisas</strong>
		</div>
		<div class='description font1'>Username</div>
	</div>
	</div>
</div>
<div class="row">
	<div class="span3" style='width:240px'>
		<div class="span1">
			
				<div class="prof-pic"><img src="img/140x140.gif" width="100px" class="img-polaroid"></div>
		
		</div>
		<div class='span2'>
		<div class='prof-info adjustment2'>
			<strong>Aiko Katherine Olaer</strong>
		</div>
		<div class='description font1'>Username</div>
	</div>
	</div>

	<div class="span3" style='width:240px;'>
		<div class="span1">
			
				<div class="prof-pic"><img src="img/140x140.gif" width="100px" class="img-polaroid"></div>
		
		</div>
		<div class='span2'>
		<div class='prof-info adjustment2'>
			<strong>Genesis Bacarrisas</strong>
		</div>
		<div class='description font1'>Username</div>
	</div>
	</div>
</div>
-->
</div>
</div>