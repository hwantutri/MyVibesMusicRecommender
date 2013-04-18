<?php

include "includes/functions.php";
include "includes/loginreq.php";
include "includes/sql_stata.php";
include('class/paginator.class.php');

//error_reporting(0);

$conn = new pgsql_db();
$uname = $_SESSION['username'];

$qry_var = "SELECT * FROM songs AS s JOIN last_played AS l on l.sid = s.sid JOIN profile AS p on p.userid = l.userid WHERE l.userid IN (SELECT userid FROM profile WHERE username IN (SELECT username FROM friends WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')))";
$num_rows = pg_num_rows(pg_query($qry_var));
	
	$pages = new Paginator;
	$pages->items_total = $num_rows;
	$pages->mid_range = 7; // Number of pages to display. Must be odd and > 3
	$pages->paginate();
	
$q = "SELECT s.*, l.date_time, p.username FROM songs AS s 
	JOIN last_played AS l on l.sid = s.sid 
	JOIN profile AS p on p.userid = l.userid WHERE l.userid IN 
	(SELECT userid FROM profile WHERE username IN 
	(SELECT username FROM friends WHERE userid = 
	(SELECT userid FROM userprof WHERE username='$uname')) 
	OR userid = (SELECT userid from userprof WHERE username='$uname'))
	ORDER BY l.date_time DESC $pages->limit";
	
$query = pg_query($q);

if($num_rows == 0){
	$timeline = "You haven't started listening to songs yet.";
}

while($row=pg_fetch_assoc($query))
{
	$row2 = "is listening to ".$row['title']." by ".$row['artist']." ";
	$timeline .= formatTweet($row2,$row['date_time'],$row['username']);
}

$sql4 =	pg_query("SELECT songs.title, songs.artist, user_pr.pagerank FROM songs, user_pr
				WHERE user_pr.sid IN (SELECT DISTINCT edges.parentid FROM edges WHERE edges.userid =(SELECT userprof.userid FROM userprof WHERE userprof.username = '$uname'))
				AND songs.sid = user_pr.sid
				ORDER BY user_pr.pagerank DESC LIMIT 10");


$row7='';
	
	$i = 1;
	while($qry = pg_fetch_array($sql4))
	{				
				$row7 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['pagerank'] . "]";
				$i++;
	}	
	
if(pg_num_rows($sql4) == 0){
 $row7 .= "No Top 10 Tracks Determined Yet.";
 }
 
$sql5 = pg_query("SELECT songs.title, songs.artist, friends_pr.pagerank FROM songs, friends_pr
				WHERE friends_pr.userid = (SELECT userprof.userid FROM userprof WHERE userprof.username = '$uname')
				AND songs.sid = friends_pr.sid
				ORDER BY friends_pr.pagerank DESC LIMIT 10");
$row8='';
	
	$i = 1;
	while($qry = pg_fetch_array($sql5))
	{				
				$row8 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['pagerank'] . "]";
				$i++;
	}	
	
if(pg_num_rows($sql5) == 0){
 $row8 .= "No Top 10 Tracks Determined Yet.";
 }
 
 $sql6 = pg_query("SELECT title, artist, global_pr.pagerank 
				   FROM songs,global_pr 
				   WHERE songs.sid = global_pr.sid 
				   ORDER BY global_pr.pagerank DESC LIMIT 10");

$row9='';

	$i = 1;
	while($qry = pg_fetch_array($sql6))
	{				
				$row9 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['pagerank'] . "]";
				$i++;
	}	
	
if(pg_num_rows($sql6) == 0){
 $row9 .= "No Top 10 Tracks Determined Yet.";
 }
 
$pc_query = pg_query("SELECT songs.sid, songs.artist, songs.title, SUM(link) AS links
					FROM 
						(SELECT songs.sid AS songid, edges.linked AS link 
							FROM songs, edges
							WHERE edges.userid = (SELECT userprof.userid FROM userprof WHERE userprof.username = '$uname')
							AND songs.sid = edges.parentid
							
						UNION ALL
						
						SELECT songs.sid AS songid, edges.linked AS link
							FROM songs, edges
							WHERE edges.userid = (SELECT userprof.userid FROM userprof WHERE userprof.username = '$uname')
							AND songs.sid = edges.childid
						) AS X, songs
					WHERE songs.sid = songid
					GROUP BY songs.sid, x.songid
					ORDER BY links DESC, title ASC LIMIT 10");

$row11='';
	
	$i = 1;
	while($qry = pg_fetch_array($pc_query))
	{				
				$row11 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['links'] . "]";
				$i++;
	}	
	
if(pg_num_rows($pc_query) == 0){
 $row11 .= "No Top 10 Tracks Determined Yet.";
 }
 
// global

$pc_query2 = pg_query("SELECT songs.sid, songs.artist, songs.title, SUM(link) AS links
					FROM 
						(SELECT songs.sid AS songid, edges.linked AS link 
							FROM songs, edges
							WHERE songs.sid = edges.parentid
							
						UNION ALL
						
						SELECT songs.sid AS songid, edges.linked AS link
							FROM songs, edges
							WHERE songs.sid = edges.childid
						) AS X, songs
					WHERE songs.sid = songid
					GROUP BY songs.sid, x.songid
					ORDER BY links DESC, title ASC LIMIT 10");

$row31='';
	
	$i = 1;
	while($qry = pg_fetch_array($pc_query2))
	{				
				$row31 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['links'] . "]";
				$i++;
	}	
	
if(pg_num_rows($pc_query2) == 0){
 $row31 .= "No Top 10 Tracks Determined Yet.";
 }
 
// friends

$idq = pg_query("SELECT userid FROM userprof WHERE username = '$uname'");
while($idqr = pg_fetch_object($idq)){
	$myid = $idqr->userid;
}
$users = array();
$users[0] = $myid;

$friends = pg_query("SELECT userprof.userid AS userid FROM userprof, friends 
							WHERE friends.userid = '$myid'
							AND userprof.username = friends.username");
							
	while($f_row = pg_fetch_array($friends)) {
		$users[] = $f_row['userid']; 		
	}

$pc_query3 = pg_query("SELECT songs.sid, songs.artist, songs.title, SUM(link) AS links
					FROM 
						(SELECT songs.sid AS songid, edges.linked AS link 
							FROM songs, edges
							WHERE edges.userid = ANY(ARRAY[" . implode(',', $users) . "]) 
							AND songs.sid = edges.parentid
							
						UNION ALL
						
						SELECT songs.sid AS songid, edges.linked AS link
							FROM songs, edges
							WHERE edges.userid = ANY(ARRAY[" . implode(',', $users) . "]) 
							AND songs.sid = edges.childid
						) AS X, songs
					WHERE songs.sid = songid
					GROUP BY songs.sid, x.songid
					ORDER BY links DESC, title ASC LIMIT 10");

$row32='';
	
	$i = 1;
	while($qry = pg_fetch_array($pc_query3))
	{				
				$row32 .= " <br/>" . $i . ".<b>" . $qry['title'] . "</b><br/>[" . $qry['links'] . "]";
				$i++;
	}	
	
if(pg_num_rows($pc_query3) == 0){
 $row32 .= "No Top 10 Tracks Determined Yet.";
 }
 
 
?>

<!DOCTYPE html>
<html>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head><script src="js/jquery.js"></script>
<!-- Bootstrap JS file (it containes predefined functionalities. Read the manual online on how to use) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/demo2.css" />
<link type="text/css" rel="stylesheet" href="css/jquery.ratings.css" />
    <script src="js/jquery.ratings.js"></script>
    <script src="js/example.js"></script>

</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header.inc.php"; ?>
<body>
	<div class="container">
		<div class="row show-grid">
		<div class='span12'>
			<div class="span4">
				<div class="row">
				<!-- Profile info -->
				<div class='row background1 profile-circle' style='width:94%;margin-left:6%'>
					<?php include "includes/prof-info.inc.php"; ?>
				</div>
				<!--Recommendation-->
				<div class="span4 recommendation background1">
					<?php include"includes/recommendation2.inc.php"; ?>
				</div>
				
				<div class="span4 recommendation background1">
					<?php include"includes/recommendation.inc.php"; ?>
				</div>
				
				</div>		
			</div>
				<!-- Timeline -->
				<div class="span7">
					<ul class="nav nav-tabs" id="myTab2">
						<li><a href="#timeline">Music Feed</a></li>
						<li><a href="#top10">My Top Hits</a></li>
						<li><a href="#friends-hits">My Circle's Hits</a></li>
						<li><a href="#community-hits">Community Hits</a></li>
					</ul>
				<!--Contents-->
					<div class="tab-content form-timeline background1 span7" style='margin-left: 0px'>
						<!-- Timeline -->	
						<div class="tab-pane" id="timeline"> 
						<?php include "includes/timeline.inc.php"; ?>
						</div>
						<!-- Top10 -->	
						<div class="tab-pane" id="top10"> 
							<?php include "includes/top10.inc.php"; ?>
						</div>
						<!--Friends Hits-->
						<div class="tab-pane" id="friends-hits">
							<?php include "includes/friends-hits.inc.php"; ?>
						</div>
						<!--Community Hits-->
						<div class="tab-pane" id="community-hits">
							<?php include "includes/community-hits.inc.php"; ?>
						</div>
					</div>
				</div>
		</div>
		
	
	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
</div>
</body>
</html>
