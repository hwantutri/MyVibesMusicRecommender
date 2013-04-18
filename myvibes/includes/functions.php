<?php

date_default_timezone_set('Asia/Manila');

function relativeTime($dt,$precision=2)
{	
$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
	$passed=strtotime(date("Y-m-d H:i:s"))-$dt;
	
	if($passed<5)
	{
		$output= "less than 5 seconds ago";
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' and ',$output).' ago';
	}
	
	return $output;
}

function formatTweet($tweet,$dt,$user)
{
	if(is_string($dt)) $dt=strtotime($dt);

	$tweet=htmlspecialchars(stripslashes($tweet));

	$path = 'img/profile/' . $user .'.jpg'; 	
	if (file_exists($path)) {
		$path = $path;
	} else {
		$path = 'img/profile/default.jpg';
	}
	
	return '
	<li>
	<a href="#"><img class="avatar" src="' . $path . '"width="28" height="28" alt="avatar" /></a>
	<div class="tweetTxt">
	<strong><a href="add-friend.php?username='.$user.'">'.$user.'</a></strong> '. preg_replace('/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i','<a href="$1" rel="nofollow" target="blank">$1</a>',$tweet).'
	<div class="date">'.relativeTime($dt).'</div>
	</div>
	<div class="clear"></div>
	</li>';

}



?>