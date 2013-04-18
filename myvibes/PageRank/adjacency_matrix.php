<?php

pg_connect("host=localhost port=5432 dbname=myvibes user=myvibes password=tseree");

// for individual rank

function adjacencyMatrix($uid) {
	$matrix = array();
	$nodes = pg_query("SELECT DISTINCT sid FROM songs ORDER BY sid ASC");
	$number_of_nodes = pg_num_rows($nodes);
	if($number_of_nodes > 0) {
		$p = pg_query("SELECT DISTINCT parentid FROM edges WHERE userid = '" . $uid . "' ORDER BY parentid ASC");
		$matrix = array_fill(0, $number_of_nodes, array_fill(0, $number_of_nodes, 0));
		while($p_row = pg_fetch_array($p, $result_type = null)) {
			$c = pg_query("SELECT songs.sid AS child, edges.linked AS linked FROM songs 
								LEFT JOIN edges ON songs.sid = edges.childid  
								WHERE parentid = '" . $p_row['parentid'] . "' AND userid = '" . $uid . "'");
			while($c_row = pg_fetch_array($c, $result_type = null)) {
				$matrix[$p_row['parentid']-1][$c_row['child']-1] = $c_row['linked'];
			}
		}
	}
	return $matrix;
}


// for global rank

function adjacencyMatrixGlb() {
	$matrix = array();
	$nodes = pg_query("SELECT DISTINCT sid FROM songs ORDER BY sid ASC");
	$number_of_nodes = pg_num_rows($nodes);
	if($number_of_nodes > 0) {
		$p = pg_query("SELECT DISTINCT parentid FROM edges ORDER BY parentid ASC");
		$matrix = array_fill(0, $number_of_nodes, array_fill(0, $number_of_nodes, 0));
		while($p_row = pg_fetch_array($p, $result_type = null)) {
			$c = pg_query("SELECT songs.sid AS child, SUM(edges.linked) AS linked FROM songs 
								LEFT JOIN edges ON songs.sid = edges.childid  
								WHERE parentid = '" . $p_row['parentid'] . "' 
								GROUP BY songs.sid");
			while($c_row = pg_fetch_array($c, $result_type = null)) {
				$matrix[$p_row['parentid']-1][$c_row['child']-1] = $c_row['linked'];
			}
		}
	}
	return $matrix;
}


// for group rank

function adjacencyMatrixGrp($uid) {
	$matrix = array();
	$users = array();
	$array = array();
	$users[0] = $uid;
	$nodes = pg_query("SELECT DISTINCT sid FROM songs ORDER BY sid ASC");
	$number_of_nodes = pg_num_rows($nodes);
	if($number_of_nodes > 0){
		$matrix = array_fill(0, $number_of_nodes, array_fill(0, $number_of_nodes, 0));
		$friends = pg_query("SELECT userprof.userid AS userid FROM userprof, friends 
							WHERE friends.userid = '$uid'
							AND userprof.username = friends.username");
		while($f_row = pg_fetch_array($friends)) {
			$users[] = $f_row['userid']; 		
		}
		$p = pg_query("SELECT DISTINCT parentid FROM edges 
							WHERE userid = ANY(ARRAY[" . implode(',', $users) . "]) 
							ORDER BY parentid ASC");
		while($p_row = pg_fetch_array($p, $result_type = null)) {
			$c = pg_query("SELECT songs.sid AS child, SUM(edges.linked) AS linked FROM songs 
								LEFT JOIN edges ON songs.sid = edges.childid  
								WHERE parentid = '" . $p_row['parentid'] . "'
								AND userid = ANY(ARRAY[" . implode(',', $users) . "])
								GROUP BY songs.sid");				
			while($c_row = pg_fetch_array($c, $result_type = null)) {
					$matrix[$p_row['parentid']-1][$c_row['child']-1] = $c_row['linked'];
			}
		}
	}
	return $matrix;
}


function users() {
	$array = array();
	$q = pg_query("SELECT userprof.userid AS userid FROM userprof");
	while($q_row = pg_fetch_array($q)){
		$array[] = $q_row['userid']; 
	}
	return $array; 
}

?>