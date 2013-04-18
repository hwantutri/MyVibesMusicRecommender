<?php
session_start();
session_name("my_apps_name");

# Check user if has logon using the defined sessions variable 
if(!isset($_SESSION['authenticated']) OR !isset($_SESSION['username']) OR 
   $_SESSION['authenticated'] == false OR $_SESSION['username'] == ""){
	# user has not logon
	header("location: login.php");
	exit;
}


# End check
?>