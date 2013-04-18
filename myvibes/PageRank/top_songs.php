<?php

pg_connect("host=localhost port=5432 dbname=myvibes user=myvibes password=tseree");

function insertToUsrPR($uid, $array){
	$size = sizeof($array);
	$checkUser = pg_query("SELECT userid FROM user_pr WHERE userid = '$uid'");
	if((pg_num_rows($checkUser)) > 0) {
		pg_query("DELETE FROM user_pr WHERE userid = $uid");	
	}
	else {
		for($i = 1; $i < $size + 1; $i++) {
			$value = $array[$i-1];
			pg_query("INSERT INTO user_pr (userid,sid,pagerank) VALUES ('$uid','$i','$value')");
		}
	}
}

function insertToGrpPR($uid, $array){
	$size = sizeof($array);
	$checkUser = pg_query("SELECT userid FROM friends_pr WHERE userid = '$uid'");
	if(pg_num_rows($checkUser) > 0) {
		pg_query("DELETE FROM friends_pr WHERE userid = $uid");	
	}
	else {
		for($i = 1; $i < $size + 1; $i++) {
			$value = $array[$i-1];
			pg_query("INSERT INTO friends_pr (userid,sid,pagerank) VALUES ('$uid','$i','$value')");
		}
	}
}


function insertToGlbPR($array){
	$size = sizeof($array);
	pg_query("DELETE FROM global_pr");
	for($i = 1; $i < $size + 1; $i++){
		$value = $array[$i-1];
		pg_query("INSERT INTO global_pr (sid,pagerank) VALUES ('$i','$value')");
	}
}

?>