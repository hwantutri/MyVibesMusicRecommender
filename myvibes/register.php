<?php
include "includes/logindb.php";
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>My Vibes - Music Recommender System</title>
<head>
<script src="jsjquery-latest.js"></script>
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
		<?php if($error_reg !=""){ ?>
		  <tr>
			 <td colspan="2" class="black"><?php 
			 echo "<div class='alert alert-error'>";
			 echo $error_reg; 	
			  echo "</div>";?></td>
		  </tr>
		  <?php } ?>
		<div class="span10 background1">
			<fieldset>
				<legend>Register</legend>
			</fieldset>
				<div class="row show-grid">
					<div class="span5">
						<form class="form-horizontal-register" method="post" action="register.php">
							<fieldset style='margin-left:20px'>
								<div class="control-group">
									<label class="control-label" for="inputUserName">Username</label>
								<div class="controls">
									<input class="input-xlarge" type="text" name="usename" id="usename" value="<?php echo $_SESSION['username']; ?>" readonly="readonly">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputFirstName">First Name</label>
								<div class="controls">
									<input class="input-xlarge" type="text" name="firstname" id="firstname" placeholder="First Name">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputLastName">Last Name</label>
								<div class="controls">
									<input class="input-xlarge" type="text" name="lastname" id="lastname" placeholder="Last Name">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputCountry">Country</label>
								<div class="controls">
									<input class="input-xlarge" type="text" name="country" id="country" placeholder="Country">
								</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
								<div class="controls">
									<input type="text" class="input-xlarge" name="email" id="email" placeholder="Email">
								</div>
								</div>
								
							</fieldset>
						
					</div>
					<div class="span5">
						<fieldset>
								<div class="control-group">
									<label class="control-label" for="inputDescription" >Description</label>
								<div class="controls">
									<textarea rows="5"class="field span4" type="text" name="desc" id="desc"></textarea>
								</div>
								</div>
								<!--<div class="control-group">
									<label class="control-label" for="inputDateOfBirth">Date of Birth</label>
								<div class="controls">			 
									<select style='width:30%;'>
										<option>Month:</option>
										<option>Jan</option>
										<option>Feb</option>
										<option>Mar</option>
										<option>Apr</option>
										<option>May</option>
										<option>Jun</option>
										<option>Jul</option>
										<option>Aug</option>
										<option>Sep</option>
										<option>Oct</option>
										<option>Nov</option>
										<option>Dec</option>
									</select>
									<select style='width:30%;'>
										<option>Day:</option>
									<?php
										for ($i=1; $i<32; $i++){
											echo "<option value=".$i.">$i</option>";
										}
									?>
									</select>
									<select style='width:30%;'>
										<option>Year:</option>
										<?php
										for ($i=1905; $i<2013; $i++){
											echo "<option value=".$i.">$i</option>";
										}
									?>
									</select>
								</div>
								</div>-->
								<div class="control-group">
									<label class="control-label" for="inputGender">Gender</label>

								<div class="radio">	
									<input type="radio" name="gender" id="gender" value="male">  Male<br>
									<input type="radio" name="gender" id="gender" value="female">  Female
								</div>
								</div>
								<!--<div class="span4" style='margin-top:20px'><img src="img/musicnotes2y.jpg" width="100%" class="img-polaroid"></div>-->
								<button type="submit" class="btn btn-inverse" style='margin-top:30px' id="btnRegister" name="btnRegister">Register</button>
							</fieldset>
					</div>
					</form>
				</div>
		</div>
		</div>
	</div>

	<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer.inc.php"; ?></div></div></div>
</div>
</body>
</html>

