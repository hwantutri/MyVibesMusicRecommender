<?php
include "includes/logindb.php";

if(isset($_SESSION['authenticated']) == true){
header("location: index.php");
}
?>





<!DOCTYPE HTML>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="js/verifynotify.js"></script> 
<!--<script type="text/javascript" src="js/fvalidateSignUp.js"></script> -->
<link rel="stylesheet" type="text/css" href="demo.css" />
</head>
<?php include "includes/login-css.inc.php";?>
<?php include "includes/login-header.inc.php";?>
<body>
<div class="container">
	<div class="span12">
	<div class="span7">
	<div class="welcome">
	  <h4><strong>Welcome to MyVibes.</strong></h4>
	  <p><strong>Your Choice. Your Love. Your Music</br>
		Find out the best music and recommendation tracks under your circle.</p>
	  </strong>
	</div>
	</div>
	<div class="span4 top-marg">
	<form class="form-horizontal" method="post" action="login.php">
	
	<?php if($error_message !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php echo $error_message; ?></td>
		  </tr>
		  <?php } ?>
		  
	<div class="signin">
		<input type="text" class="span4" name="username" id="username" style='width:95%' placeholder="Username">
	</div>
	<div class="signin">
		<input type="password" class="span3" name="password" id="password" style='width:67%'placeholder="Password">
		<button type="submit" class="btn btn-info" id="btnLogin" name="btnLogin">Sign in</button>
	</div>
	<div class="signin">
		<label class="checkbox muted">
		  <small><input type="checkbox">Remember Me | <a href="url">Forgot password?</a></small>
		</label>
		  
	</div>
	</form>
	</div>
	<div class="span4 top-marg">
	<form name=passform class="form-horizontal-signup" method="post" action="login.php" >
	
	
		  
		  
	<fieldset>
	<legend>Sign Up for MyVibes</legend>
	<?php if($error_message2 !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php echo $errs; ?></td>
		  </tr>
		  <?php } ?>
		  <div id="password_result">&nbsp; </div><br />
	<input type="text" class="span4" placeholder="Username" style='width:95%' name="username2" id="username2"/>
	<br />	<span id="username_status"></span>  <!-- adjust -->
	<input type="password" class="span4" style='width:95%' placeholder="Password" name="password" id="password" onKeyUp="verify.check()" />
	<input type="password" class="span4" style='width:95%' placeholder="Retype Password" name="repassword" id="repassword" onKeyUp="verify.check()" /></fieldset>
	
	<button type="submit" input name="btnSignUp" id="btnSignUp" class="btn btn-inverse" disabled="disabled" />Sign Up</button>
	</form>
	</div>
	
	
			<SCRIPT TYPE="text/javascript">
			<!--

			verify = new verifynotify();
			verify.field1 = document.passform.password;
			verify.field2 = document.passform.repassword;
			verify.result_id = "password_result";
			verify.match_html = "<span style='color:green'>Passwords match.</span>";
			verify.nomatch_html = "Please make sure your passwords match.";

			// Update the result message
			verify.check();

			// -->
			</SCRIPT>

</div>
</div>
<?php include "includes/footer.inc.php";?>
<!-- /container -->
<!-- jQuery latest version since Bootstrap is dependent on it -->
<script src="js/jquery-latest.js"></script>
<!-- Bootstrap JS file (it containes predefined functionalities. Read the manual online on how to use) -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/users.js"></script>

</body>
</html>
