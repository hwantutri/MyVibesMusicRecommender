
<?php

include "includes/loginreq.php";
include "includes/sql_statd.php";
require "functions.php";
error_reporting(0);	

$conn = new pgsql_db();
// remove tweets older than 1 hour to prevent spam
//mysql_query("DELETE FROM demo_twitter_timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
//fetch the timeline
$q = mysql_query("SELECT * FROM demo_twitter_timeline ORDER BY ID DESC");

$timeline='';
while($row=mysql_fetch_assoc($q))
{
	$timeline.=formatTweet($row['tweet'],$row['dt']);
}

// fetch the latest tweet
$lastTweet = '';
list($lastTweet) = mysql_fetch_array(mysql_query("SELECT tweet FROM demo_twitter_timeline ORDER BY id DESC LIMIT 1"));

if(!$lastTweet) $lastTweet = "You don't have any tweets yet!";

?>
