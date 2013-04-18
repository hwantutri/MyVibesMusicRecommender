<?php
include "includes/loginreq.php";
include "includes/sql_stata.php";

include('class/paginator.class.php');

error_reporting(0);

$conn = new pgsql_db();
$uname = $_SESSION['username'];


//output $res2				
$qry_var = "SELECT COUNT (*) FROM friends WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
$num_rows2 = $conn->get_var($qry_var);

	$pages = new Paginator;
	$pages->items_total = $num_rows2[0];
	$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
	$pages->paginate();
// remove tweets older than 1 hour to prevent spam
//mysql_query("DELETE FROM timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
$page1 = $pages->display_pages();
$q = "SELECT DISTINCT * FROM friends WHERE userid = (SELECT userid FROM userprof WHERE username='$uname') ORDER BY username ASC";
$res2 = $conn->get_results($q);



//output $data
$query1 = "SELECT COUNT (*) FROM profile WHERE firstname ILIKE '%$_REQUEST[tb1]%' OR lastname ILIKE '%$_REQUEST[tb1]%' OR username ILIKE '%$_REQUEST[tb1]%'";
 $num_rows = $conn->get_var($query1);
 
 
 $pages = new Paginator;
 $pages->items_total = $num_rows[0];
 $pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
 $pages->paginate();
 
 $page3 = $pages->display_pages(); 
 $query = "SELECT DISTINCT * FROM profile WHERE firstname ILIKE '%$_REQUEST[tb1]%' OR lastname ILIKE '%$_REQUEST[tb1]%' OR username ILIKE '%$_REQUEST[tb1]%' ORDER BY userid ASC";
 $data = $conn->get_results($query, "a");
 

 $debug = 0;
 
 if ($debug == 1){
 var_dump($data);
 }

 //output $result
 $query1 = "SELECT COUNT (*) FROM profile";
$num_rows4 = $conn->get_var($query1);

	$pages = new Paginator;
	$pages->items_total = $num_rows4[0];
	$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
	$pages->paginate();
// remove tweets older than 1 hour to prevent spam
//mysql_query("DELETE FROM timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
$page11 = $pages->display_pages();
$query2 = "SELECT DISTINCT * FROM profile ORDER BY username ASC";
$result = $conn->get_results($query2);
 
 
//output $dataout
$query2 = "SELECT COUNT (*) FROM friends WHERE (userid = (SELECT userid FROM userprof WHERE username='$uname')) AND (firstname ILIKE '%$_REQUEST[tb11]%' OR lastname ILIKE '%$_REQUEST[tb11]%' OR username ILIKE '%$_REQUEST[tb11]%')";
$num_row3 = $conn->get_var($query2);
//var_dump($num_row3);
 
 $pages = new Paginator;
 $pages->items_total = $num_row3[0];
 $pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
 $pages->paginate();
 
 $page4 = $pages->display_pages();
 $query4 = "SELECT DISTINCT * FROM friends WHERE (userid = (SELECT userid FROM userprof WHERE username='$uname')) AND (firstname ILIKE '%$_REQUEST[tb11]%' OR lastname ILIKE '%$_REQUEST[tb11]%' OR username ILIKE '%$_REQUEST[tb11]%') ORDER BY username ASC";
 $dataout = $conn->get_results($query4);
?>

<!DOCTYPE html>
<html>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/tabs.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header-friends.inc.php"; ?>
<body>

	<div class="container">
		<div class="row show-grid">
		<div class="span12">
			<div class="span4">
				<div class="row">
				<!-- Profile info -->
				<div class='row background1 profile-circle' style='width:94%;margin-left:6%'>
					<?php include "includes/prof-info.inc.php"; ?>
				</div>
				</div>
			</div>
			<!--Tabs-->
			<div class="span7">
			<ul class="nav nav-tabs" id="myTab">
				<li><a href="#listfriends">List of Friends</a></li>
				<li><a href="#viewusers">View all Users</a></li>
			</ul>
			<div class="tab-content">
			<!--list of friends-->
			<div class="tab-pane" id="listfriends"> 
			<div class="list-friends background1">
				<div class='row' style='margin-left:0px'>
					<?php include "includes/friends.inc.php"; ?>
				</div>
			</div>
			</div>
			<!--View Users-->
			<div class="tab-pane" id="viewusers"> 
			<div class="list-friends background1">
				<div class='row' style='margin-left:0px'>
					<?php include "includes/friendsall.inc.php"; ?>
				</div>
			</div>
			</div>
			</div>
		</div>
		</div>
	</div>
	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
	</div>
</body>
</html>