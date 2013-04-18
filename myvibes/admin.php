<!DOCTYPE HTML>
<html>
<link rel="shortcut icon" type="image/ico" href="img/logo.ico"/>
<meta charset="utf-8">
<title>MyVibes - Music Recommender System</title>
<head><script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="js/tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/demo2.css" />
<script type="text/javascript" src="js/script2.js"></script>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "includes/css.inc.php"; ?>
<?php include "includes/header-profile.inc.php"; ?>
	<body>
		<div class="container">
			<div class="row requestsContainer">
				<?php
				if(!empty($request))
			 	 { ?>
					<div class="row"><div class="span5"><h4>MyVibes MRS Admin</h4></div></div>
					<div class="row">
					<div class="span8">
						<form class="form-search" name="results" method="get" action="admission.home.php">
						  <input class="input-medium" type="text" name="studfirstname" placeholder="Firstname"/>
                          <input class="input-small" type="text" name="studlastname" placeholder="Lastname"/>
                          <input class="input-small" type="text" name="studid" placeholder="ID Number"/>
                    
                          <select class="input-medium" name="status" id="status" >
                          <option value=""> Status </option>
                          <option value="PENDING">PENDING </option>
                          <option value="DECLINED">DECLINED </option>
                          <option value="APPROVED">APPROVED </option>
                          </select>
                          <button type="submit" class="btn btn-info btn-small" name="btnSearch"><i class="icon-search"></i></button>
                        
                   </form>
					</div>
						<div class="span3 offset=1"><div><?php $pagination->display_basic(); ?></div></div>						
					</div>
				<div class="span12">
					<table class="table table-striped table-bordered table-hover" > 
						<tr>
							<th>Request ID</th>
							<th>Date Requested</th>
							<th>ID Number</th>
							<th>Name</th>
							<th>Remarks</th>
							<th>Status</th>
							<th>Details</th>
						</tr>			
					</table>
					<div class="pagination pagination-centered"><?php $pagination->display_pagination(); ?></div>
		  <?php  } ?>
			    </div>	
		    </div>
			<div class="row"><div class="span12"><div class="footerInverse"><?php include "includes/footer.inc.php"; ?></div></div></div>
		</div>		
	</body>
</html>