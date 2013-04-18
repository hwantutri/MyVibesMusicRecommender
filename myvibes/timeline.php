<?php

include "includes/functions.php";
include "includes/loginreq.php";
//include "includes/submit.php";

error_reporting(0);

$conn = new pgsql_db();
// remove tweets older than 1 hour to prevent spam
//mysql_query("DELETE FROM timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
//fetch the timeline
$q = "SELECT * FROM tweets ORDER BY ID DESC";
$query = pg_query($q);
$timeline='';

while($row=pg_fetch_assoc($query))
{
	$timeline.=formatTweet($row['tweet'],$row['dt']);
}



// fetch the latest tweet
$lastTweet = '';
$q2 = "SELECT tweet FROM tweets ORDER BY id DESC LIMIT 1";
list($lastTweet) = $conn->get_results($q2);

//var_dump($lastTweet);


if(!$lastTweet)  {
$lastTweet = "You don't have any tweets yet!";

}
//var_dump($lastTweet);
?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Vibes - Music Recommender System</title>
<meta name="viewport">
<!--?php include "includes/css.inc.php"; ?> ?php include "includes/header.inc.php"; ?> -->
<head>
<link rel="stylesheet" type="text/css" href="css/demo2.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script2.js"></script>
</head>
<body>
<br/>
<br/>
&nbsp; <br/><div id="twitter-container">
<form id="tweetForm" action="submit.php" method="post">

<span class="counter">140</span>
<label for="inputField">What are you doing?</label>

<textarea name="inputField" id="inputField" tabindex="1" rows="2" cols="40" ></textarea>
<input class="submitButton inact" name="submit" type="submit" value="update" disabled="disabled" />

<span class="latest"><strong>Latest: </strong><span id="lastTweet"><?php=$lastTweet?></span></span>
<!--<php echo $lastTweet; ?>-->
<div class="clear"></div>

</form>

<h3 class="timeline">Timeline</h3>

<ul class="statuses"><?php echo $timeline?></ul>



</div>


	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>

<!-- /container -->
<!-- jQuery latest version since Bootstrap is dependent on it -->
<script src="js/jquery-latest.js"></script>
<script src="js/jquery.js"></script>
<!-- Bootstrap JS file (it containes predefined functionalities. Read the manual online on how to use) -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>