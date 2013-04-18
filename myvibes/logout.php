<?php
session_start();
session_name("my_apps_name");

# destroy session variables
session_destroy();
unset($_SESSION['authenticated']);
unset($_SESSION['username']);

header("location:login.php");
exit;
?>