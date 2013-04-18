<?php

//http://x4150apps.msuiit.edu.ph/myvibes/

pg_connect("host=localhost port=5432 dbname=myvibes user=myvibes password=tseree");

//pgsql queries from data_collector.php

function test($test){
	pg_query("INSERT INTO test (test_column) VALUES ('$test')");
}


function getUserId($username){
	$q = pg_query("SELECT userid from userprof WHERE username='$username'");
	while($row = pg_fetch_object($q)){	
		$uid = $row->userid;
	}
	return $uid;
}

function confirmUser($uid,$pass){
	return pg_num_rows(pg_query("SELECT userid from userprof WHERE userid='$uid' AND password='$pass'"));
}

function checkElapsed($uid){
	return pg_num_rows(pg_query("SELECT userid from elapsed	WHERE userid='$uid'"));
}

function insertIntoLastPlayed($uid,$sid,$lc){
	pg_query("INSERT INTO last_played (userid,sid,date_time,last_child) VALUES ('$uid','$sid',NOW(),'$lc')");
}

function insertIntoElapsed($uid,$sid,$ctl){
	pg_query("INSERT INTO elapsed (userid, start_time, end_time, sid, curr_track_length)
				VALUES('$uid',NOW(),NOW(),'$sid','$ctl')");
}

function updateElapsed($uid,$sid,$curr){
	pg_query("UPDATE elapsed
				SET sid='$sid', start_time=NOW(), end_time=NOW(), curr_track_length='$curr'
				WHERE userid='$uid'");
}

//check for the duplicate of the song in the 'songs' table

function checkDuplicate($title,$artist){
	return pg_num_rows(pg_query("SELECT sid from songs WHERE title='$title' AND artist='$artist'"));}

function insertDataIntoSongsTable($artist,$title,$album,$year,$genre){
	pg_query("INSERT INTO songs (title, artist, album, year, genre)
				VALUES ('$title','$artist','$album','$year','$genre')");
}

function getSongId($title,$artist){
	$q = pg_query("SELECT sid from songs WHERE title='$title' AND artist='$artist'");
	while($row = pg_fetch_object($q)){	
		$sid = $row->sid;
	}
	return $sid;
}

function getSongIdFromElapsed($uid){
	$q = pg_query("SELECT sid from elapsed WHERE userid='$uid'");
	while($row = pg_fetch_object($q)){	
		$e_sid = $row->sid;
	}
	return $e_sid;
}

function getLastChild($uid){
	$q = pg_query("SELECT last_child from last_played WHERE userid='$uid' ORDER BY date_time DESC LIMIT 1");
	while($row = pg_fetch_object($q)){	
		$lc = $row->last_child;
	}
	return $lc;
}

function checkLastChild($uid){
	return pg_num_rows(pg_query("SELECT last_child from last_played WHERE userid='$uid'"));	
}

function updateElapsedEnd($uid,$sid){
	pg_query("UPDATE elapsed SET end_time=NOW() WHERE userid='$uid' AND sid='$sid'");	
}

function getStartTime($uid,$sid){
	$q = pg_query("SELECT start_time FROM elapsed WHERE sid='$sid' AND userid='$uid'");
	while($row = pg_fetch_object($q)){	
		$s = $row->start_time;
	}
	return $s;
}

function getEndTime($uid,$sid){
	$q = pg_query("SELECT end_time FROM elapsed WHERE sid='$sid' AND userid='$uid'");
	while($row = pg_fetch_object($q)){	
		$e = $row->end_time;
	}
	return $e;
}

function getCurrentLengthOfSong($uid,$sid){
	$q = pg_query("SELECT curr_track_length FROM elapsed WHERE sid='$sid' AND userid='$uid'");
	while($row = pg_fetch_object($q)){	
		$ctl = $row->curr_track_length;
	}
	return $ctl;
}

function checkEdge($uid,$l_id,$sid){
	return pg_num_rows(pg_query("SELECT parentid from edges where parentid='$l_id' AND childid='$sid' AND userid='$uid'"));
}

function linked($uid,$l_id,$sid){
	$q = pg_query("SELECT linked from edges where parentid='$l_id' AND childid='$sid' AND userid='$uid'");
	while($row = pg_fetch_object($q)){	
		$l = $row->linked;
	}
	return $l;
}

function updateLinkedEdges($uid,$l_id,$e_sid,$linked){
	pg_query("UPDATE edges SET linked='$linked' WHERE parentid='$l_id' AND childid='$e_sid' AND userid='$uid'");	
}

function insertIntoEdges($uid,$l_id,$sid,$linked){
	pg_query("INSERT INTO edges (userid,parentid,childid,linked) VALUES('$uid','$l_id','$sid','$linked')");
}

function deleteEdge($uid,$l_id,$e_sid){
	pg_query("DELETE from edges WHERE userid='$uid' AND parentid='$l_id' AND childid='$e_sid'");
}

?>
