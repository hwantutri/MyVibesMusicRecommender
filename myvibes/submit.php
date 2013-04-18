<?php

include "includes/functions.php";
include "includes/loginreq.php";
error_reporting(0);

$conn = new pgsql_db();

if(ini_get('magic_quotes_gpc'))
$_POST['inputField']=stripslashes($_POST['inputField']);
$gett = trim($_POST['inputField']);
$postit = pg_escape_string($gett);


	if(mb_strlen($_POST['inputField']) < 1 || mb_strlen($_POST['inputField'])>140)
	{
		die ("0");
	}


$pqry = "INSERT INTO tweets(tweet, dt) VALUES ('$postit', NOW())";
$exec = $conn->query($pqry);


	if(pg_affected_rows($this->db_conn)!=1){
	die("0");
	}



echo formatTweet($_POST['inputField'],time());

?>
