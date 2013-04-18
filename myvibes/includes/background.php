<?php 


$uname = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information
$fileName1 = substr_replace($uname , '.jpg', strrpos($uname , '.') +$uname); // The file name
$fileName = "{$uname}{$fileName1}";
$fileTmpLoc = $_FILES["uploaded_file2"]["tmp_name"]; // File in the PHP tmp folder

// Place it into your "uploads" folder mow using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, "img/background/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult == true) {
	echo "<div id='filename2'>$fileName</div>";
}
}

?>