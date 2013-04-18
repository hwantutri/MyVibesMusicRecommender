<?php 

$conn = new pgsql_db();
$error_msg = "";
$success_msg = "";
$error = "";
$success = "";
$usename = $_SESSION['username'];

$edit = "SELECT * FROM profile WHERE userid = (SELECT userid FROM userprof WHERE username ='$usename')";
$editqry = $conn->get_results($edit, "a");

if($editqry){

foreach($editqry as $res){
$firstname = $res['firstname'];
$lastname = $res['lastname'];
$country = $res['country'];
$description = $res['description'];
$email = $res['emailaddress'];
$description = $res['description'];

}
}
else{
$error .= "You haven't registered your details yet. Go back to and register <a href='register.php'> here. </a>";

}


if(isset($_POST['btnUpdt'])) 
{

$usename = $_SESSION['username'];


		isset($_POST['firstname']);			
		isset($_POST['lastname']);
		isset($_POST['country']);
		isset($_POST['description']);
		isset($_POST['emailaddress']);
		isset($_POST['gender']);
		
		
		
		

	
$semaphore = false;
$query = "UPDATE profile SET ";
$fields = array('firstname','lastname','country', 'description', 'emailaddress','gender');
	foreach ($fields as $field) {
		if (isset($_POST[$field]) and !empty($_POST[$field]) ){
		$var = pg_escape_string($_POST[$field]);
		$query .= $field." = '$var',";
		$semaphore = true;
		
		}
	}


if (isset($semaphore)) {
   $query .= " username = '$usename' WHERE username = '$usename'";
    $qry = NULL;
   $qry = $conn->query($query);
}

if(isset($qry)){
 $success .= "Successfully Updated Your Information! Go back to your <a href='profile.php'> profile. </a>";

}
else if($_POST['firstname']=="" && $_POST['lastname']=="" &&  $_POST['country']=="" && $_POST['description']=="" && $_POST['emailaddress']=="" && $_POST['gender']==""){

$success .= 'Nothing to update.';
}
else{
$error .= 'Error in updating profile. Try again.';
}

		
		
}



if(isset($_POST['btnChangePass'])) 
{
		

		$usename = $_SESSION['username'];
		$password = pg_escape_string($_POST['current']);
		$cpassword = pg_escape_string($_POST['password']);
		$repassword = pg_escape_string($_POST['repassword']);
		
		if($password=="" OR $cpassword == "" OR $repassword=="")
   {
		$error_msg .= "No password to update.";
   }
   else{
		# Check password with our users table
		$sql = "SELECT COUNT(*) 
		        FROM userprof
				WHERE username = '".$usename."' AND password = '".$password."'";
#echo $sql;
		$exist = $conn->get_var($sql);
        if($exist > 0)
		{
			$query = "UPDATE userprof SET password='$cpassword' WHERE username = '$usename'";
			
				$qry = $conn->query($query);
				$qry;
				$success_msg .= "Successfully Updated Your Password. Go back to your <a href='profile.php'> profile. </a>";
				
		}
		else{
			$error_msg .= "Current password is not correct.";
		}
   }
   
 		
}

if(isset($_POST['btnCancel'])){
header("location:index.php");
}

?>
