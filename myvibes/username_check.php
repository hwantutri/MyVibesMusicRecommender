

<?php
 
 include "class/pgsql_db.class.php";

$conn = new pgsql_db();
 
 if(isset($_POST['username2']))
{
	$username = trim($_POST['username2']);
	
	
		
		if(!$username=="")
		{
		
			$sql = "SELECT COUNT('username') 
		        FROM userprof
				WHERE username = '".$username."'";
			$exist = $conn->get_var($sql);
				if($exist > 0)
				{
				echo 'Sorry, That username is Taken!';
				}
				else{
				echo 'Username available!';
				}
					
		} 
	
}
?>