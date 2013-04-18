<?php

include "class/pgsql_db.class.php";

$conn = new pgsql_db();


# Set variables to use
$error_message = "";
error_reporting(0);	


if(isset($_POST['btnAddFriend'])) 
{

		$uname = $_POST['usename'];
		$usename = $_SESSION['username'];
		$reqid = 0;
		
		$sql = "INSERT INTO friendreq(sender, receiver, reqid) VALUES ( '$usename', '$uname', '$reqid')";
		
		$inserted = $conn->query($sql);
		echo var_dump($inserted);
		
		exit;
		
   
   
 } 
 
 
 ?>