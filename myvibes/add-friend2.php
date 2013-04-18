<?php
include "includes/loginreq.php";
include "includes/sql_statb.php";
include "includes/functions.php";
include('class/paginator.class.php');

error_reporting(0);

$conn = new pgsql_db();
$usename = $_GET['username'];
$page2 = '';
	
$qry_var = "SELECT COUNT (*) FROM songs AS s JOIN last_played AS l on l.sid = s.sid WHERE l.userid = (SELECT userid FROM profile WHERE username = '$usename')";
$num_rows = $conn->get_var($qry_var);
//var_dump($num_rows);

	$pages = new Paginator;
	$pages->items_total = $num_rows[0];
	$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
	$pages->paginate();

	
$page2 .= $pages->display_pages();
$q = "SELECT s.*, l.date_time FROM songs AS s JOIN last_played AS l on l.sid = s.sid WHERE l.userid = (SELECT userid FROM profile WHERE username = '$usename') ORDER BY l.date_time ASC $pages->limit";
$query = pg_query($q);
$ry = $conn->get_results($q);
//var_dump($query);
$timeline='';

while($row=pg_fetch_assoc($query))
{
	$row2 = "is listening to ".$row['title']." by ".$row['artist']." ";
	$timeline.=formatTweet($row2,$row['date_time'],$usename);
}

if(!$timeline){
$timeline .="This user hasn't started listening to songs yet.";
$page2 .= '';
}


$sql4 = pg_query("SELECT top_songs FROM user_top_songs WHERE userid = (SELECT userid FROM userprof WHERE username='$usename')");
$res = pg_fetch_array($sql4);


$songs = explode(";", $res['top_songs']);
$row7='';

foreach($songs as $cat) {
	
    $cat = trim($cat);
	$sql6 = pg_query("SELECT * FROM songs WHERE sid = $cat");

	
	while($qry = pg_fetch_array($sql6))
	{				
				$row7 .= " <br/>".$qry['title']." by ".$qry['artist']." ";								
	}	
	
}
 if(!$sql6){
 $row7 .= "This user hasn't determined their Top 10 songs yet.";
 }
?>

<!DOCTYPE html>
<html>

<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>My Vibes - Music Recommender System</title>
<head>
<script src="js/jquery-latest.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/demo2.css" />
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header-friends.inc.php"; ?>
<body>

	<div class="container">
	<div class="span12">
		<div class="row show-grid">
		<div class="span3 offset1">
			<!--Profile info-->
				<div class="row background1 profile-circle">
					<?php include "includes/add-friend-prof.inc.php"; ?>
					<!--//?php
						//$vinput=$_GET['username'];

						//echo"Visitor <i><u> $vinput</u></i> is chosen.";
 
					//?>-->
				</div>
			</div>
			<!--Tabs-->
			<div class="span7">
			<ul class="nav nav-tabs" id="myTab">
				<li><a href="#tracks">Tracks</a></li>
				<li><a href="#top10">Top 10 Hits</a></li>
			</ul>
			<div class="tab-content form-tracks background1">
			<!--Tracks-->
			<div class="tab-pane" id="tracks">
				<?php include "includes/tracks.inc.php"; ?>
			</div>
			<!-- Top10 -->	
				<div class="tab-pane" id="top10"> 
				
					<?php include "includes/top10.inc.php"; ?>
				
				</div>
		</div>
		</div>
	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
</div>
</div>
</div>
</body>
</html>