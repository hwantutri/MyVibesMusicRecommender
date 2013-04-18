<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/login-css.inc.php";?>
<?php include "includes/contact-header.inc.php";?>
<body>
<div class="container">
	<!--<div class="row show-grid">-->
	<div class="span12">
		<div class="span11">
		<div class="span10 background1">
			<fieldset>
				<center><div class="pic"><img src="img/2213.png" width= "40%"/></div>
				<div class="tagline"><img src="img/tagline.png" width= "40%"/></div>
				</center>
				<div class="description">
				<p style='color:black;margin: 20px 40px 20px 40px'>Thank you for your interest in <a href="http://x4150apps.msuiit.edu.ph/myvibes">My Vibes</a>. Please leave any COMMENTS and SUGGESTIONS you may have to help us IMPROVE our site. Don't hesitate to leave any QUESTIONS you may have about MyVibes.com and the services that we have to offer. We'll get to back to you within # hours.</p></div>
			</fieldset>
				<div class="row show-grid">
					<div class="span5">
						<form class="form-horizontal-register">
							<fieldset style='margin:0px 20px 0px 20px'>
								<div class="control-group">
									<label class="control-label" for="inputFullName">Full Name</label>
								<div class="controls">
									<input class="span4" type="text">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
								<div class="controls">
									<input class="span4" type="email">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputSubject">Subject</label>
								<div class="controls">
									<input class="span4" type="text">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputMessage">Message</label>
								<div class="controls">
									<textarea rows="5"class="field span4"></textarea>
								</div>
								</div>
								<button type="submit" class="btn btn-success" style='margin-top:10px'>Submit</button>
							</fieldset>
						
					</div>
					<div class="span5">
						<fieldset style='margin-top:20px'>
								<div class="contact"><img src="img/contact-us-logo.jpg" width= "90%"/></div>
						</fieldset>
					</div>
					</form>
				</div>
		</div>
		</div>
	</div>

	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer.inc.php"; ?></div></div></div>
</div>
<!-- /container -->
<!-- jQuery latest version since Bootstrap is dependent on it -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!-- Bootstrap JS file (it containes predefined functionalities. Read the manual online on how to use) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
</body>
</html>