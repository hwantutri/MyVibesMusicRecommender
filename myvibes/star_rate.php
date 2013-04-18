<?php

include "includes/loginreq.php";

$conn = new pgsql_db();
$username = $_SESSION['username'];

if(isset($_POST['star']) && isset($_POST['extra']))
{
$extra = $_POST['extra'];
$star = $_POST['star'];
$get_id = "SELECT COUNT(*) FROM rating WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
$qry = $conn->get_var($get_id);

if($qry == 0){
	$sql = "INSERT INTO rating(pagerank_u, playcount_u, pagerank_g, playcount_g, pagerank_f, playcount_f,userid) (SELECT 0,0,0,0,0,0,userid FROM userprof WHERE username ='$username')";
	$conn->query($sql);
}

	if($extra == 'user_prten'){
	$sql = "UPDATE rating SET pagerank_u='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	else if($extra == 'user_pcten'){
	$sql = "UPDATE rating SET playcount_u='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	else if($extra == 'global_prten'){
	$sql = "UPDATE rating SET pagerank_g='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	else if($extra == 'global_pcten'){
	$sql = "UPDATE rating SET playcount_g='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	else if($extra == 'friends_prten'){
	$sql = "UPDATE rating SET pagerank_f='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	else if($extra == 'friends_pcten'){
	$sql = "UPDATE rating SET playcount_f='$star' WHERE userid = (SELECT userid FROM userprof WHERE username='$username')";
	}
	$conn->query($sql);
}
?>