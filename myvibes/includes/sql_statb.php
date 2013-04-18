<?php

# Instantiate class/es to use
$conn = new pgsql_db();
error_reporting(0);	

if(isset($_POST['btnAddFriend'])) 
{

		$uname = $_POST['usename'];
		$usename = $_SESSION['username'];
		$reqid = 0;
		
		$sql = "INSERT INTO friendreq(sender, receiver, reqid) VALUES ( '$usename', '$uname', '$reqid')";
		
		$inserted = $conn->query($sql);
		
			if($inserted){
		
			echo  '<script language="javascript">';  
			echo   ' window.location="add-friend.php?username='.$uname.'";'; 
			echo  '</script>';
		
			exit;
		
		}
		
	
   
 } 
 
$results4 = array();
				$usename = $_SESSION['username'];
				$uname = $_GET['username'];
				$sql = "SELECT * FROM profile WHERE userid = (SELECT userid FROM userprof WHERE username='$uname')";
				$results4 = $conn->get_results($sql);


				$n =0;
				while($n<count($results4)){
				
					$row = (array)json_decode(json_encode($results4[$n]));
					$row8 = "<a href='add-friend.php?username=".$row['username']."'><font color ='black'><div style='min-width:100px; padding:5px;'>".$row['firstname']." ".$row['lastname']."<br/></div></font></a>";
					$row9 = "<div style='min-width:100px; padding:5px;word-wrap:break-word;'>".$row['description']." "."<br/></div>";
					$row10 = "<div style='min-width:100px; padding:5px;'>".$row['gender']." "."<br/></div>";
					$row30 = "<div style='min-width:100px; padding:5px;'>".$row['emailaddress']." "."<br/></div>";
					$n++;
					
				}				
				
				
$sql2 = "SELECT COUNT(*) FROM friends WHERE username = '".$uname."' AND userid = (SELECT userid FROM userprof WHERE username='$usename')";
$sql3 = "SELECT COUNT(*) FROM friendreq WHERE sender = '".$usename."' AND receiver = '".$uname."'";
$sql4 = "SELECT COUNT(*) FROM friendreq WHERE sender = '".$uname."' AND receiver = '".$usename."'";

#echo $sql;
$exist = $conn->get_var($sql2);
$existtrace = $conn->get_var($sql3);
$existence = $conn->get_var($sql4);

/*var_dump($exist);*/

		

        if($exist > 0)
		{
			$results5 = '<div style="min-width:100px; padding:5px;">Friends<img src="img/check.jpg" width="14px"></div>';
		}		
		else 
		{
			if($existtrace > 0){
				$results5 = "<button class='btn btn-info' type='submit' style='margin-top:5px;' disabled>Pending Friend Request</button>";
				}
			else if($existence > 0){
				$results5 = "<a href='friendreq.php'				
				<center>Respond to Friend Request</center></a>"
				;
			}
			else if($usename == $uname){
				$results5 = '';
			}
			else{
			$results5 = "<button class='btn btn-info' type='submit' style='margin-top:5px;' id='btnAddFriend' name='btnAddFriend'>Add as Friend</button>";
			}
		}


 $uname = $_GET['username'];
$sql4 = "SELECT COUNT(*) FROM profile WHERE username = '".$uname."'";
$exist2 = $conn->get_var($sql4);


if($exist2 == "0"){
				echo  '<script language="javascript">'; 
			//	echo  'alert("Username not found!" );'; 
				echo    ' window.location="friends.php";'; 
				echo  '</script>';
			}  

 
 
?>