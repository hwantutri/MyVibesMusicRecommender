<?php

session_start();
session_name("my_apps_name");

# Set all the php files to be incliude
include "class/pgsql_db.class.php";

$conn = new pgsql_db();


# Set variables to use
$error_message = "";
$error_message2 ="";
$error_reg = "";

if(isset($_POST['btnLogin']))
{
   $username = str_replace("'","''",trim(pg_escape_string($_POST['username'])));
   $password = str_replace("'","''",trim(pg_escape_string($_POST['password'])));
   
   if($username=="" OR $password == "")
   {
		$error_message .= "Please fill-in username and password";
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
			# Ok ang username ug password, naa sa database
			$_SESSION['authenticated'] = true;
			$_SESSION['username'] = $username;
			header("location:index.php");
			exit;
		}
		else{
			$error_message .= "Invalid username or password!";
		}
   }
}


if(isset($_POST['btnSignUp'])) 
{
	$username = trim(pg_escape_string($_POST['username2']));
	$repass = trim(pg_escape_string($_POST['repassword']));
	$password = trim(pg_escape_string($_POST['password']));
	//var_dump($_POST);
   
   if($username=="" OR $password == "" OR $repass=="")
   {
		$error_message2 .= "Please fill-in all values.";
		
   }
   else{
				$sql = "SELECT COUNT('username') 
		        FROM userprof
				WHERE username = '".$username."'";
			$exist = $conn->get_var($sql);
				if($exist > 0)
				{
				 $error_message2 .= "Username is Taken!";
				
				}
				else{
				$sql = "INSERT INTO userprof(username, password) VALUES ( '$username', '$password')";
		
				$inserted = $conn->query($sql);
				$_SESSION['authenticated'] = true;
				$_SESSION['username'] = $username;
				header("location:register.php");
				exit;
		
				}
					

	}	

 } 
 
 
 
 if(isset($_POST['btnRegister'])) 
{
	
	$usename = trim(pg_escape_string($_POST['usename']));
	$fname = trim(pg_escape_string($_POST['firstname']));
	$lname = trim(pg_escape_string($_POST['lastname']));
	$country = trim(pg_escape_string($_POST['country']));
	$email = trim(pg_escape_string($_POST['email']));
	$desc = trim(pg_escape_string($_POST['desc']));
	$gender = trim($_POST['gender']);
	//var_dump($_POST);
   
   if($fname=="" OR $lname =="" OR $country=="" OR $email=="" OR $desc=="" OR $gender=="")
   {
		$error_reg .=  "Please fill-in every field.";

   }
   else{	
		$uname = $_SESSION['username'];
		$sql = "INSERT INTO profile(username, firstname, lastname, gender, country, description, emailaddress, userid)( SELECT '$usename', '$fname', '$lname', '$gender', '$country', '$desc', '$email', userid FROM userprof WHERE username='$uname')";
		
		$inserted = $conn->query($sql);
		
		if($inserted){
			$_SESSION['authenticated'] = true;
			$_SESSION['username'] = $uname;
			header("location:plugin.php");
			exit;
			}
		else{
		$error_reg .= "Error in registering. Please try again.";
		
		}
		}
		
	} 

 
 
 ?>