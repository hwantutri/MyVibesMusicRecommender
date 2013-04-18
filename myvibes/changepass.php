
<?php 

include "includes/loginreq.php";
include "includes/sql_statf.php";


?>


<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head>
<script type="text/javascript" src="js/verifynotify.js"
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/jquery-latest.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/profile.js"></script> 
<script type="text/javascript" src="js/background.js"></script>
<?php include "includes/css(edit-prof).inc.php"; ?>
<?php include "includes/header-profile.inc.php"; ?>
</head>
<body>
<div class="container">
	<div class="span12">
		<div class="span11">
		
		<?php if($success_msg !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-success'>";
			 echo $success_msg; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
			
			<?php if($error_msg !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-error'>";
			 echo $error_msg; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
		<div class="span10 background1">
		<form class="form-horizontal-register" method="post" action="" name=passform>
			<fieldset>
				<legend>Change Password</legend>
			</fieldset>
			
				<div class="row show-grid">
					<div class="span4 offset3">					
								<div class="control-group">
									<label class="control-label" for="inputPassword">Current Password</label>
								<div class="controls">
									<input type="password" class="input-xlarge" name="current" id="current"placeholder="Current Password">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword">New Password</label>
								<div class="controls">
									<input type="password" class="input-xlarge" name="password" id="password"onKeyUp="verify.check()"placeholder="New Password"  >
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword">Verify Password</label>
								<div class="controls">
									<input type="password" class="input-xlarge" name="repassword" id="repassword"
									onKeyUp="verify.check()" placeholder="Confirm Password"  >
								</div>
								<div id="password_result">&nbsp; </div><br />
								</div>
								<!--<div class="but2"><button type="submit" class="btn btn-primary">Save Changes</button>
								<button type="button" class="btn">Cancel</button></div>-->
					<div class="pull-right"><button type="submit" class="btn btn-success" input name="btnChangePass" id="btnChangePass" >Save Password</button>
					<button type="submit" class="btn" input name="btnCancel" id="btnCancel">Cancel</button></div>
				</div>			
				</div>
				</form>
		</div>
		</div>
	</div>
<SCRIPT TYPE="text/javascript">
			<!--

			verify = new verifynotify();
			verify.field1 = document.passform.password;
			verify.field2 = document.passform.repassword;
			verify.result_id = "password_result";
			verify.match_html = "<span style='color:green'>Passwords match.</span>";
			verify.nomatch_html = "<span style='color:red'>Please make sure your passwords match.</span>";

			// Update the result message
			verify.check();

			// -->
			</SCRIPT>
	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer-index.inc.php"; ?></div></div></div>
</div>

</body>
</html>

