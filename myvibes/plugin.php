<?php
include "includes/logindb.php";
?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>My Vibes - Music Recommender System</title>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/login-css.inc.php";?>
<?php include "includes/login-header.inc.php";?>
<body>
<div class="container">
	<div class="span12">
		<div class="span11">
		<div class="span10 background1">
			<fieldset>
				<center><div class="pic"><img src="img/2213.png" width= "40%"/></div>
				<div class="tagline"><img src="img/tagline.png" width= "40%"/></div>
				</center>
				<div class="description">
				<p style='color:black;margin: 20px 40px 20px 40px'>Before you proceed, you are required to download the Winamp Player(version 5.3 or higher) and the Winamp Plug-in.</br></br>
				Download the Winamp Player <a href="http://www.winamp.com/media-player/all" target="_blank">Version 5.63</a> or <a href="http://www.filehippo.com/download_winamp/changelog/11218/" target="_blank">Version 5.623</a>.</br>
				Download the Winamp Plugin <b><a href="download/gen_music_reporter.dll" target="_blank">HERE.</a></b></br></br></br>
				After downloading, follow these steps to activate the plug-in. </br></br>
					1. Copy the plugin to <b>Program Files</b>(Or wherever you installed Winamp) >> <b>Winamp</b> >> <b>Plugins</b></br></br>
					2. Open the Winamp application. </br><center><img src="img/plugin-install/1.jpg" width= "70%"></center></p>
				<p style='color:black;margin: 20px 40px 20px 40px'>
					3. Go to <b>Options</b> >> <b>Preferences</b>.</br> <center><img src="img/plugin-install/2.jpg" width= "70%"></center></p>
				<p style='color:black;margin: 20px 40px 20px 40px'>
					4. Find <b>Plugins</b> >> <b>General Purpose</b> and open the appropriate plug-in (gen_music_reporter.dll). </br><center><img src="img/plugin-install/3.jpg" width= "50%"></center></p>
				<p style='color:red;margin: 20px 40px 20px 40px'>
					<b>NOTE:</b> If you can't find the plugin on the <b>General Purpose</b>, please download the dependency file Microsoft Visual C++ 2010 Redistributable Package <b><a href="http://www.microsoft.com/en-us/download/details.aspx?id=5555" target="_blank">HERE</b></a> and install. Repeat this step after installing.</p>
				<p style='color:black;margin: 20px 40px 20px 40px'>
					5. Check the box next to the <b>"Enable MyVibes Winamp Plugin"</b>. </br><center><img src="img/plugin-install/4.jpg" width= "30%"></center></p>
				<p style='color:black;margin: 20px 40px 20px 40px'>
					6. Enter your username and password (the one you use to enter the MyVibes Website).</br></br>
					7. Click <b>Okay</b>.</br></br>
					8. Close the Winamp <b>Preferences Window</b>. </br><center><img src="img/plugin-install/5.jpg" width= "50%"></center></p>
				<p style='color:black;margin: 20px 40px 20px 40px'>
					9. <b>Play</b> Your Music!</br>
					</br></br>
					
					After downloading, visit your <b><a href="profile.php" width= "50%">profile</a></b>.</br>
 </p>
				
				</div>
			</fieldset>
		</div>
		</div>
	</div>

	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer.inc.php"; ?></div></div></div>
</div>
</body>
</html>

