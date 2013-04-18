<?php

include "includes/functions.php";
include "includes/loginreq.php";
include "includes/sql_stata.php";
include('class/paginator.class.php');
//include "star_rate.php";

//error_reporting(0);

$conn = new pgsql_db();
$uname = $_SESSION['username'];
$page2 = '';
	
$qry_var = "SELECT COUNT (*) FROM songs AS s JOIN last_played AS l on l.sid = s.sid WHERE l.userid = (SELECT userid FROM profile WHERE username = '$uname')";
$num_rows = $conn->get_var($qry_var);
//var_dump($num_rows);

	$pages = new Paginator;
	$pages->items_total = $num_rows[0];
	$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
	$pages->paginate();

	
$page2 .= $pages->display_pages();
$q = "SELECT s.*, l.date_time FROM songs AS s JOIN last_played AS l on l.sid = s.sid WHERE l.userid = (SELECT userid FROM profile WHERE username = '$uname') ORDER BY l.date_time DESC";
$query = pg_query($q);
$ry = $conn->get_results($q);
//var_dump($ry);
$timeline='';

while($row=pg_fetch_assoc($query))
{
	$row2 = "is listening to ".$row['title']." by ".$row['artist']." ";
	$timeline.=formatTweet($row2,$row['date_time'],$uname);
}

if(!$timeline){
$timeline .="You haven't started listening to songs yet.";
//$page2 .= '';
}


$sql4 =	pg_query("SELECT songs.title, songs.artist, user_pr.pagerank FROM songs, user_pr
				WHERE user_pr.sid IN (SELECT DISTINCT last_played.sid FROM last_played WHERE last_played.userid = (SELECT userprof.userid FROM userprof WHERE userprof.username = '$uname'))
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
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/demo2.css" />
<script type="text/javascript" src="js/script2.js"></script>
<link type="text/css" rel="stylesheet" href="css/jquery.ratings.css" />
<script src="js/jquery.ratings.js"></script>
<script src="js/example.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header-profile.inc.php"; ?>
<body>

	<div class="container">
	<div class="span12">
		<div class="row show-grid">
			<div class="span3 offset1">
			<!--Profile info-->
				<div class="row background1 profile-circle">
					<?php include "includes/profile.inc.php"; ?>
				</div>
			</div>
			<!--Tabs-->
			<div class="span7">
			<ul class="nav nav-tabs" id="myTab2">
				<li><a href="#tracks">Tracks</a></li>
				<li><a href="#top10">My Top Hits</a></li>
				<li><a href="#friends-hits">My Circle's Hits</a></li>
				<li><a href="#community-hits">Community Hits</a></li>
			</ul>
			<!--Contents-->
			<div class="tab-content form-tracks background1">
				<!-- Tracks -->	
				<div class="tab-pane" id="tracks"> 
				<?php include "includes/tracks.inc.php"; ?>
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
</div>
</body>
</html>