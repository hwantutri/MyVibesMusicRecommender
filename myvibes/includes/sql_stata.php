<?php



error_reporting(0);

$conn = new pgsql_db();
$uname = $_SESSION['username'];



$results = array();
				$uname = $_SESSION['username'];
				$sql = "SELECT * FROM profile WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
				$results = $conn->get_results($sql);
				
				$n =0;
				
			while($n<count($results)){
				$row = (array)json_decode(json_encode($results[$n]));				
				$row2 =	"<a href='add-friend.php?username=".$row['username']."'><font color ='black'><div style='min-width:100px; padding:5px;'>".$row['firstname']." ".$row['lastname']."<br/></div></font></a>";
				$n++;
					}
				
			if(!$results){
				$row2 = "<div style='min-width:100px; padding:5px;'>You-Who-Did-Not-Register-A-Name-Yet<br/><a href='register.php'> (Register Your Details Here)</a></div>";
					}

				
$results2 = array();
				$uname = $_SESSION['username'];
				$sql2 = "SELECT * FROM friends WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
				$results2 = $conn->get_results($sql2);
				
$results3 = array();
				$uname = $_SESSION['username'];
				$sql = "SELECT * FROM profile WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
				$results3 = $conn->get_results($sql);
				
				$n =0;
				while($n<count($results3)){
				
					$row = (array)json_decode(json_encode($results3[$n]));
					$row3 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>".$row['description']." "."<br/></div>";
					$row4 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>".$row['gender']." "."<br/></div>";
					$row5 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>".$row['emailaddress']." "."<br/></div>";
					$n++;
					
				}
				
				if(!$results3){
				$row3 = "<div style='min-width:100px; padding:5px; word-wrap:break-word;'>No description registered.<br/></div>";
					}
				if(!$results3){
				$row4 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>Err..Gender?<br/></div>";
					}
				if(!$results3){
				$row5 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>No emailaddress registered<br/></div>";
					}

				
$results5 = array();
				$uname = $_SESSION['username'];
				$sql = "SELECT * FROM profile WHERE username IN(SELECT sender FROM friendreq WHERE receiver='$uname' AND reqid = '0')";
$results5 = $conn->get_results($sql);


$results6 = array();
				$uname = $_SESSION['username'];
				$sql = "SELECT COUNT(*) FROM friendreq WHERE receiver IN(SELECT username FROM userprof WHERE username='$uname')";
$results6 = $conn->get_var($sql);



$sql3 = "SELECT DISTINCT COUNT(*) D FROM friends WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
			$results4 = $conn->get_var($sql3);

				if($results4 > 0)
				{
					$row6 = "<strong><a href='friends.php'>".$results4."</a></strong>";
				}
				else{
					$row6 = "<div style='min-width:100px; padding:5px;'>No friends added.<br/></div>";
				}
				
				
 if(isset($_POST['btnrmvf'])) 
{

		
		$uname = $_POST['usrname'];
		$usename = $_SESSION['username'];

		
		
		$sql = "DELETE from friends WHERE username='$uname' AND userid = (SELECT userid FROM userprof WHERE username='$usename')";
		$sql2 = "DELETE from friends WHERE username='$usename' AND userid = (SELECT userid FROM userprof WHERE username='$uname')";
		
		$inserted = $conn->query($sql);
		$inserted2 = $conn->query($sql2);
		/*var_dump($inserted);*/
		
		echo  '<script language="javascript">'; 
       // echo  'alert("Friend Deleted" );'; 
        echo    ' window.location="friends.php";'; 
        echo  '</script>';
		
   
   
 } 
 

 
?>
				
	
