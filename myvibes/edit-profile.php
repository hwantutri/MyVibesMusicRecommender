
<?php 

include "includes/loginreq.php";
include "includes/sql_statf.php";
include "includes/sql_stata.php";





?>


<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/profile.js"></script> 
<script type="text/javascript" src="js/background.js"></script>
<?php include "includes/css(edit-prof).inc.php"; ?>
<?php include "includes/header-profile.inc.php"; ?>
</head>
<body>
<div class="container">
	<div class="span12">
		<div class="span11">
		
		<?php if (isset($picupload)){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-success'>";
			 echo $picupload; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
		
		
		<?php if($success !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-success'>";
			 echo $success; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
		  
		  <?php if($error !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-error'>";
			 echo $error; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
		  
		<div class="span10 background1">
		<form class="form-horizontal-register" method="post" action="" name=regform>
			<fieldset>
				<legend>Edit Profile</legend>
			</fieldset>
				<div class="row show-grid">
					<div class="span5">
						<form class="form-horizontal-register" method="post" action="">
							<fieldset style='margin-left:20px'>
								<div class="control-group">
									<label class="control-label" for="inputFirstName">First Name</label>
								<div class="controls">
									<input class="input-xlarge" type="text"  name="firstname" id="firstname"placeholder="First Name" value="<?php echo $firstname?>">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputLastName">Last Name</label>
								<div class="controls">
									<input class="input-xlarge" type="text" placeholder="Last Name" name="lastname" id="lastname" value="<?php echo $lastname?>">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputCountry">Country</label>
								<div class="controls">
									<input class="input-xlarge" type="text" placeholder="Country" name="country" id="country" value="<?php echo $country?>">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
								<div class="controls">
									<input type="email" class="input-xlarge" placeholder="Email" name="emailaddress" id="emailaddress" value="<?php echo $email?>">
								</div>
								</div>
							</fieldset>
						</form>
					</div>
				
					<div class="span5">
						<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputDescription">Description</label>
								<div class="controls">
									<textarea rows="5"class="field span4" name="description"id="description"><?php echo $description?></textarea>
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputGender">Gender</label>

								<div class="radio radio-custom">	
									<input type="radio" name="gender" id="gender" value="male" <?php echo($gender == "male" ? 'checked="checked"': ''); ?>>  Male<br>
									<input type="radio" name="gender" id="gender" value="female" <?php echo($gender == "female" ? 'checked="checked"': ''); ?> >  Female
								</div>
								</div>
								
								
										<div class="but"><button type="submit" class="btn btn-info" name="btnUpdt" id="btnUpdt">Save Changes</button>
								<button type="button" class="btn" name="btnCancel" id="btnCancel"><a href='index.php' style="text-decoration:none;">Cancel</a></button></div>
								
								</form>
									<div id="image_wrapper" style="display:none;"><img id="preview" class="span1" style="margin-right:15px" src=""/>
									<form id="upload" name="upload" enctype="multipart/form-data" method="post" action="profilepic.php" target="upload_target">
									
									<p style="margin-top:25px; margin-left:10px;">Choose another profile picture:</p><div class="upload" style="margin-left:25%;"><input  name="uploaded_file" type="file" size="30" id="uploaded_file">
									<input id="sent" name="sent" type="submit"  value="Upload" /></div>
									</form>
									</div>
									<iframe id="upload_target" name="upload_target" style="width:10px; height:10px; display:none"></iframe>
								<iframe id="upload_target" name="upload_target" style="width:10px; height:10px; display:none"></iframe>
								<div id="upload_wrapper" class="prof-pic">
									<form id="upload" name="upload" enctype="multipart/form-data" method="post" action="profilepic.php" target="upload_target">
									<div class="span1" style='margin-right:15px'><div class="prof-pic"><img src="img/profile/<?php echo $_SESSION['username']; ?>.jpg"  width=100 class="img-polaroid" style="margin-right:15px"></div></div>
									<p style="margin-top:25px; margin-left:10px;">Change your profile picture here:</p><div class="upload" style="margin-left:25%;"><input  name="uploaded_file" type="file" size="30" id="uploaded_file"></br>					
									<input id="sent" name="sent" type="submit"  value="Upload" /></div>
									<?php
										if (isset($result)) {
												echo "<p><strong>$result</strong></p>";
										}
									?>
									</form>
								</div>
									<div id="loading" style="background:url(img/ajax-loader.gif) no-repeat left; height:50px; width:370px; display:none;">
									<p style="margin-left:40px; padding-top:15px;">Uploading File... Please wait</p>
									</div>
									
										
									
						
							</fieldset>
					</div>
					</div>
				
		</div>
		</div>
	</div>
	</div>
	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
</div>
</body>
</html>

