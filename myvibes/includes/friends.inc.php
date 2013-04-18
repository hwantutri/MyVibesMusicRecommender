	<form method="POST" action="friends.php"> 
	<div class="friends-title">
	
	<input style='margin-right:1%;' type="text" name="tb11" onchange="submit()" class="input-medium search-query">Search</div>
	</form>

<hr>
<div class="lists">

<div class="row">

		<!--?php echo $page1 ?>-->
		<?php					
				
				if(!empty($_REQUEST['tb11'])){
				
				$n =0;
				while($n<count($dataout)){
				
					$row = (array)json_decode(json_encode($dataout[$n]));
						print "<form id='rmvf' name='rmvf' method='post' action=''>";
						print "<div class='span5'>";
						print "<div class='span1'>";	
						echo "<input type='hidden' name='usrname' id='usrname' value='".$row['username']."'>";
						echo "<div class='prof-pic'><img src='";
						$path = 'img/profile/' . $row['username'] .'.jpg'; 
						if (file_exists($path)) {
							echo $path;
						} else {
							echo 'img/profile/default.jpg';
						}
						echo "' width='100px' class='img-polaroid' /></div>";
						//echo $image;
						print "</div>";
						print "<div class='span2' style='width: 55%'>";
						print "<div class='prof-info adjustment1'>";
						print "<strong>";
						print "<a href='add-friend.php?username=".$row['username']."'>".$row['firstname']." ".$row['lastname']."</a> ";
						print "</strong>";
						print "</div>";
						print "<div class='description adjustment3 font1'>";
						print "".$row['description']." ";
						print "</div>";
						print "</div>";
						print "</div>";
						print "<div class='span2' style='margin-left:-5px'><button class='btn btn-small btn-info' type='submit' id='btnrmvf' name='btnrmvf' style='margin:25px 0px 0px 0px'>Remove as Friend</button></div>";
						print "</form>";
					$n++;
					
				}
				if(!$dataout){
				echo "<div class='list1'>";
				echo "You haven't added friends yet! </div>";
			
				}
			
				//echo "<div class='pagination pagination-centered'>";
				//echo $page4;
				//echo "</div>";
				
}
else{
				$n =0;
				while($n<count($res2)){
				
					$row = (array)json_decode(json_encode($res2[$n]));
						print "<form id='rmvf' name='rmvf' method='post' action=''>";
						print "<div class='span5'>";
						print "<div class='span1'>";	
						echo "<input type='hidden' name='usrname' id='usrname' value='".$row['username']."'>";
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
						print "<div class='description adjustment3 font1'>";
						print "".$row['description']." ";
						print "</div>";
						print "</div>";
						print "</div>";
						print "<div class='span2' style='margin-left:-5px'><button class='btn btn-small btn-info' type='submit' id='btnrmvf' name='btnrmvf' style='margin:25px 0px 0px 0px;'>Remove as Friend</button></div>";
						print "</form>";
					$n++;
					
				}
				if(!$res2){
				echo "<div class='list1'>";
				echo "You haven't added friends yet!";
				echo "</div>";
				}
				//echo "<div class='pagination pagination-centered'>";
				//echo $page1;
				//echo "</div>";
				

	}
			
				?> 
		</div>
	<hr>

	 <!--<ul>
   <li><a href="#">Prev</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">Next</a></li>
  </ul>-->

</div>