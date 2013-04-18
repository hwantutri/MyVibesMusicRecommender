<?php 


$conn = new pgsql_db();
$error_message = "";
//error_reporting(0);	

if(isset($_POST['btnReg'])) 
{

		$_POST['fname'];
		$_POST['lname'];
		$_POST['place'];
		$_POST['email'];
		$_POST['desc'];
		$_POST['gender'];


		$usename = $_SESSION['username'];
		
$semaphore = false;
$query = "UPDATE profile SET ";
$fields = array('fname','lname','place', 'email', 'desc', 'gender');
	foreach ($fields as $field) {
		if (isset($_POST[$field]) and !empty($_POST[$field]) ){
		$var = pg_escape_string($_POST[$field]);
		$query .= $field." = '$var',";
		$semaphore = true;
		}
	}

if ($semaphore) {
   $query .= " username = '$usename' WHERE username = '$usename'";
   $qry = $conn->query($query);
   $qry;
   var_dump($query);
}
else{
$error_message .= "<div class='alert alert-error'>Oh snap! Error in updating profile. </div>";
}
 
		
		
}

if(isset($_POST['btnChangePass'])) 
{
		$_POST['current'];
		$_POST['password'];
		$_POST['repassword'];
		

		$usename = $_SESSION['username'];
		$changepass = $_POST['password'];
		
		
		if($_POST['current']=="" OR $_POST['password'] == "" OR $_POST['repassword']=="")
   {
		$error_msg .= "Please fill all values";
   }
   else{
		# Check username and password with our users table
		$sql = "SELECT COUNT(*) 
		        FROM userprof
				WHERE username = '".$username."' AND password = '".$password."'";
#echo $sql;
		$exist = $conn->get_var($sql);
        if($exist > 0)
		{
			$query = "UPDATE userprof SET password='$changepass' WHERE username = '$usename'";
			
				$qry = $conn->query($query);
				$qry;
				var_dump($qry);
				
		}
		else{
			$error_msg .= "Current password is not correct.";
		}
   }
   
 		
}
?>