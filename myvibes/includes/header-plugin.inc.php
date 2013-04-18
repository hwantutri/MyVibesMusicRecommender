<?php $conn = new pgsql_db();
$uname = $_SESSION['username']; 

$resname = array();
$name = "SELECT firstname,lastname FROM profile WHERE username = '$uname'";
$resname = pg_query($name);
//var_dump($resname);

while($row=pg_fetch_assoc($resname))
{
	$row21 = "".$row['firstname']." ".$row['lastname']." ";
	
}
?>
<div class="navbar navbar-inverse navbar-fixed-top"> 
  <div class="navbar-inner"> 
    <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
      <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
      </a> <a class="brand" href="index.php"><img src="img/2213.png" width= "100px"/></a>
      <div class="nav-collapse collapse"> 
        <ul class="nav">
          <li><a href="index.php"><i class="icon-home" style='margin-right:5px'></i>Home</a></li>
		  
		<li><a href="friends.php"><i class="icon-user"></i><i class="icon-user" style='margin-right:5px'></i>Friends</a></li>
		<li class="active"><a href="plugin-index.php"></i><i class="icon-download" style='margin-right:5px'></i>Download Winamp Plugin</a></li>

        </ul>
		<ul class="nav pull-right">
			
			<li class="dropdown"><a href="profile.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false"><i class="icon-user" style='margin-right:5px'></i><?php echo $row21;?><b class="caret" style='margin-left:5px'></b></a>
				<ul class="dropdown-menu">
				<li><a tabindex="-1" href="profile.php"><i class="icon-eye-open" style='margin-right:5px'></i>View Profile</a></li>
				<li><a tabindex="-1" href="edit-profile.php"><i class="icon-edit" style='margin-right:5px'></i>Edit Profile</a></li>
				<li><a tabindex="-1" href="changepass.php"><i class="icon-wrench" style='margin-right:5px'></i>Change Password</a></li>
				<li class="divider"></li>
				<li><a tabindex="-1" href="logout.php"><i class="icon-off" style='margin-right:5px'></i>Logout</a></li>
				</ul>
		</li>
			
		</ul>
	
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>
</div>
</div>