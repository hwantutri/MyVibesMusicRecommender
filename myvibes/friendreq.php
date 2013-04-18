<?php
include "includes/loginreq.php";
include "includes/sql_statc.php";
include "includes/sql_stata.php";

?>

<!DOCTYPE html>
<html>

<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head>
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
 <script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.js"></script>



</head>
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header.inc.php"; ?>
<body>

	<div class="container">
	<div class="row show-grid">
		<div class="span12">
			<div class='span4'>
				<!--prof info-->
				<div class='row background1 profile-circle' style='width:94%;margin-left:6%'>
					<?php include "includes/prof-info.inc.php"; ?>
				</div>
				
			</div>
			
			<!--list of friends requests-->
			<div class="span7 background1 list-friends">
				<div class='row' style='margin-left:0px'>
				<div class="friends-title">
				<strong>Friend Requests:</strong>
				</div>
				<hr>
<div class="lists">

<div class="row" style='margin-left:10px'>
			<?php	
			
				//if($num_rows > 0)
				//{
				//echo 'You have "'.$num_rows.'" friend //request/s! <br/> <br/>';
				//}
				
				if($results5){
	
					$n=0;
				while($n<count($results5)){
				
					$row = (array)json_decode(json_encode($results5[$n]));
					echo "<form id='friendreq' name='friendreq' method='post' action=''>";
					print "<div class='span4'>";
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
					print "<div class='span2' style='margin-top:10%;width: 55%'>";
					print "<div class='prof-info'>";
					print "<strong>";
					echo "<a href='add-friend.php?username=".$row['username']."'>".$row['firstname']." ".$row['lastname']."</a> ";
					print "</strong>";
					print "</div>";
					print "<div class='description adjustment3 font1'>";
					echo "<input type='hidden'  name='fqname' id='fqname' value='".$row['username']."'>".$row['username']."";
					print "</div>";
					print "</div>";
					print "</div>";					
					echo "<div class='span2' style='margin-left:-5px;margin-top:6%'><button type='submit' id='btnAccept' name='btnAccept'>";
					echo "Accept";
					echo "</button>";
					echo "<button type='submit' id='btnDecline' name='btnDecline'>";
					echo "Decline";
					echo "</button><br/></div>";
					echo "</form>";
				
					$n++;
					
				}
			}
	else{
	
			echo 'No Friend Requests.';
	}
				?>
			</div>
			<div class="pagination pagination-centered">
			<?php  $pages->display_pages(); ?>
			</div>
			</div>
			</div>
		</div>
		</div>

	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
</div>
</div>
</body>
</html>