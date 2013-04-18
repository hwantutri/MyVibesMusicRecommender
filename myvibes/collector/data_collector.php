<?php

include "includes/dc_queries.inc.php";

date_default_timezone_set("Asia/Manila");

if(isset($_GET['u']) && isset($_GET['p']) && isset($_GET['song'])){
	
	$username = $_GET['u'];
	$password = $_GET['p'];
	$song = $_GET['song'];
	$uid = getUserId($username);
	
	list($artist,$title,$album,$year,$genre,$length) = explode(" - ", pg_escape_string(utf8_encode(($song))));

	$confirm_user = confirmUser($uid,$password);
	
	if($confirm_user > 0){
		if(empty($song)){
			$check_elapsed = checkElapsed($uid);
			if($check_elapsed == 0){
				insertIntoElapsed($uid,0,'00:00');	
			}
			else {
				updateElapsed($uid,0,'00:00');			
			}
			exit();
		}
		else {
			if((strlen($title) == 0) || (strlen($artist) == 0)){
				exit();
			}
			$check_duplicate = checkDuplicate($title,$artist);
			if($check_duplicate == 0){
				insertDataIntoSongsTable($artist,$title,$album,$year,$genre);
			}
			$sid = getSongId($title,$artist);
			$e_sid = getSongIdFromElapsed($uid);
			if($e_sid == 0){
				updateElapsed($uid,$sid,$length);
				$lc = checkLastChild($uid);
				if($lc > 0){
					$last_child = getLastChild($uid);
					insertIntoLastPlayed($uid,$sid,$last_child);
				}
				elseif($lc == 0) {
					insertIntoLastPlayed($uid,$sid,0);
				}
			}
			else {
				$last_child = getLastChild($uid);
				if($last_child == 0){
					updateElapsedEnd($uid,$e_sid);
					$start = getStartTime($uid,$e_sid);
					$end = getEndTime($uid,$e_sid);
					$new_start = strtotime($start);
					$new_end = strtotime($end);
					$elapsed = date('i:s',$new_end - $new_start);
					$length_of_song = getCurrentLengthOfSong($uid,$e_sid);
					$percentage = get_percentage($elapsed,$length_of_song);
					updateElapsed($uid,$sid,$length);
					$min_percentage = 85;
					if($percentage >= $min_percentage){
						insertIntoLastPlayed($uid,$sid,$e_sid);
					}
					else {
						insertIntoLastPlayed($uid,$sid,0);
					}
				}
				elseif($last_child > 0) {
					updateElapsedEnd($uid,$e_sid);
					$start = getStartTime($uid,$e_sid);
					$end = getEndTime($uid,$e_sid);
					$new_start = strtotime($start);
					$new_end = strtotime($end);
					$elapsed = date('i:s',$new_end - $new_start);
					$length_of_song = getCurrentLengthOfSong($uid,$e_sid);
					$percentage = get_percentage($elapsed,$length_of_song);
					updateElapsed($uid,$sid,$length);
					$min_percentage = 85;
					$check_edge = checkEdge($uid,$last_child,$e_sid);
					if($percentage >= $min_percentage){
						if(($check_edge == 0) && ($last_child != $e_sid)){
							insertIntoEdges($uid,$last_child,$e_sid,1);
						}
						else {
							$linked = linked($uid,$last_child,$e_sid);
							$linked = $linked + 1;
							updateLinkedEdges($uid,$last_child,$e_sid,$linked);
						}
						insertIntoLastPlayed($uid,$sid,$e_sid);
					}
					else {
						$linked = linked($uid,$last_child,$e_sid);
						$linked = $linked - 1;
						if($linked == 0){
							deleteEdge($uid,$last_child,$e_sid);
						}
						else {
							updateLinkedEdges($uid,$last_child,$e_sid,$linked);
						}
						insertIntoLastPlayed($uid,$sid,$last_child);						
					}
				}				
			}	
		}	
	}
}


// get percentage 

function get_percentage($x,$y){
	$default = strtotime("00:00:00");
	if(strlen($y)<=5){
		$y = strtotime('00:'.$y) - $default;
		if(strlen($x)<=5){
			$x = strtotime('00:'.$x) - $default;
			return ($x * 100)/$y;
		}else{
			return 100;
		}
	}else{
		$x = strtotime($x) - $default;
		$y = strtotime($y) - $default;
		return ($x * 100)/$y;
	}
}

?>