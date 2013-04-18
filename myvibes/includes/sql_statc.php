<?php

# Instantiate class/es to use
$conn = new pgsql_db();
include('class/paginator.class.php');
error_reporting(0);		
					
		
				$uname = $_SESSION['username'];
				
				$query = "SELECT COUNT (*) FROM profile WHERE username IN(SELECT sender FROM friendreq WHERE receiver='$uname' AND reqid = '0')";
				$num_rows = $conn->get_var($query);
 
 
			

				
				$pages = new Paginator;
				$pages->items_total = $num_rows[0];
				$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
				$pages->paginate();
				
			
				
				
				
	$results4 = array();
				$uname = $_SESSION['username'];
				$sql2 = "SELECT DISTINCT * FROM profile WHERE username IN(SELECT sender FROM friendreq WHERE receiver='$uname' AND reqid = '0') ORDER BY userid ASC";
				$results4 = $conn->get_results($sql2);	
				//var_dump($results4);
								
				 
	

	
if(isset($_POST['btnAccept'])) 
{

		$uname = pg_escape_string($_POST['fqname']);
		$usename = $_SESSION['username'];
		$reqid = 0;
		
		
		$sql3 = "SELECT userid FROM profile WHERE username='$usename'";
		$sql7 = "SELECT userid FROM profile WHERE username='$uname'";
		$inserted3 = $conn->get_var($sql3);
		$inserted4 = $conn->get_var($sql7);
		$sql = "INSERT INTO friends(firstname, lastname, username, description, country, userid) SELECT firstname, lastname, username, description, country, '$inserted3' FROM profile WHERE username='$uname'";
		$sql6 = "INSERT INTO friends(firstname, lastname, username, description, country, userid) SELECT firstname, lastname, username, description, country, '$inserted4' FROM profile WHERE username='$usename'";
		$sql2 = "DELETE from friendreq WHERE sender='$uname' AND receiver='$usename'";
		$inserted = $conn->query($sql);
		$inserted5 = $conn->query($sql6);
		/*var_dump($inserted);*/
		$inserted2 = $conn->query($sql2);
		echo  '<script language="javascript">'; 
      //  echo  'alert("Friend Added!" );'; 
        echo    ' window.location="friendreq.php";'; 
        echo  '</script>';
		
		
   
   
 } 
 
 
 if(isset($_POST['btnDecline'])) 
{

		$uname = pg_escape_string($_POST['fqname']);
		$usename = $_SESSION['username'];
		$reqid = 0;
		
		
		
		$sql = "DELETE from friendreq WHERE sender='$uname' AND receiver='$usename'";
		
		$inserted = $conn->query($sql);
		/*var_dump($inserted);*/

		echo  '<script language="javascript">'; 
//echo  'alert("Friend Request Declined." );'; 
        echo    ' window.location="friendreq.php";'; 
        echo  '</script>';
		
		
   
   
 } 
?>