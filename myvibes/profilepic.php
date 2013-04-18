<?php 

include "includes/loginreq.php";

$uname = $_SESSION['username'];
isset($_FILES['uploaded file']);
$picupload ='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$allowedExts = array("jpg", "jpeg",);
$extension = end(explode(".", $_FILES["uploaded_file"]["name"]));
if ((($_FILES["uploaded_file"]["type"] == "image/jpeg") || ($_FILES["uploaded_file"]["type"] == "image/pjpeg")) && ($_FILES["uploaded_file"]["size"] < 2000000)&& in_array($extension, $allowedExts))
  {
	if ($_FILES["uploaded_file"]["error"] > 0)
		{
			$result = "File exceeds 2mb. Upload another. <br>";
		}
	else
		{
		$fileName1 = substr_replace($uname , '.jpg', strrpos($uname , '.') +$uname); // The file name
		$fileName = "{$uname}{$fileName1}";
		$fileTmpLoc = $_FILES["uploaded_file"]["tmp_name"]; // File in the PHP tmp folder
		$moveResult = move_uploaded_file($fileTmpLoc, "img/profile/$fileName");
		if ($moveResult == true) {
			echo "<div id='filename'>$fileName</div>";
			$picupload .="Successfully Changed Your Profile Photo.";
		}
		}
  }  
else
 {
  $result = "Invalid file type. Jpg/Jpeg allowed.";
 }
  

// Access the $_FILES global variable for this specific file being uploaded
// and create local PHP variables from the $_FILES array of information


// Place it into your "uploads" folder mow using the move_uploaded_file() function

// Check to make sure the move result is true before continuing

}

?>