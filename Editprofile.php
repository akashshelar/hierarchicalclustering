<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');

if(!$con)
{
	die("connection failed" . mysqli_error($con));
}
if(!isset($_SESSION['sess_user']) && $_SESSION['sess_user'] == '')
{
	header('Location:index.php');
}
$message = "";
if(isset($_POST["update_user"])){
	$email  = $_POST['emailid'];
	$username = $_POST['username'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	
	if(strlen($age) == 2 && is_numeric($age))
	{
	$str = "update signlog set name='".$username."', age='".$age."', phone='".$phone."' where email='".$email."'";
	if ($con->query($str) === TRUE)
	{
		$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						Profile Updated successfully.
					</div>';
	}
	else
	{
		$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						Failed to update profile.
					</div>';
	}
	}
	else
	{
		$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						Age should be only 2 charecters long and in numeric format.
					</div>';
	}
}

$sql = "select name,gender,age,phone from signlog where email = '".$_SESSION['sess_user']."'";
$result=mysqli_query($con,$sql);
while($row = $result->fetch_assoc()) {
 $uname = $row['name'];
 $ugender = $row['gender'];
 $uage = $row['age'];
 $uphone = $row['phone'];
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport"><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trek Social</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"><!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"><!-- BootstrapValidator CSS -->
	<link href="css/bootstrapValidator.min.css" rel="stylesheet"><!-- jQuery and Bootstrap JS --><script src="js/jquery.min.js" type="text/javascript"></script><script src="js/bootstrap.min.js" type="text/javascript"></script><!-- BootstrapValidator --><script src="js/bootstrapValidator.min.js" type="text/javascript"></script><script src="js/custom.js" type="text/javascript"></script>
</head>
<body><!-- NavBar Top Begins -->
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container clearfix">
		<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><img class="img-rounded" src="img/TrekSocial_Trial.jpg"></div>
		
		<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="UserPreference.php">Home</a></li>
			<li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
		</div>
		</div>
		</div>
		<!-- NavBar Top Ends -->
		
		<div class="col-lg-3">
<div class="jumbotron">
<style>
.show_menu {
display: block !important;
}
.submenu {
display: none;
}
</style>
<ul type="square">
	<li><font color="Blue" font="" size="4"><a href="UserPreference.php" target="_top">Set Preferences</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="ViewDestinations.php" target="_top">View destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Groups.php" target="_top">View your groups</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Rate_Review.php" target="_top">Rate and Review Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Suggestdestination.php" target="_top">Suggest New Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="feedback.php" target="_top">Write to us</a></font></li>
	<li onclick='openDropDown()'><font color="Blue" font="" size="4"><a href="javascript:void(0);" target="_top">Settings</a></font>
    	<ul id='drpdwn' class='submenu'>
        	<li><font color="Blue" font="" size="4"><a href="Editprofile.php" target="_top">Edit Profile</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="ChangePassword.php" target="_top">Change Password</a></font></li>
            <li onClick="Deactivate_account('<?php echo $_SESSION['sess_user']; ?>')"><font color="Blue" font="" size="4"><a href="javascript:void(0);" target="_top">Deactivate Account</a></font></li>
        </ul>
    </li>
	
</ul>
<script>
function openDropDown()
{
	$('#drpdwn').toggleClass('show_menu');
} 
</script>
</div>
</div>
		
		<div class="col-lg-9 container">
		<div class="panel-body">
        <center><?php echo $message; ?></center>
		<form action="#" class="form_rightl" method="POST" name="Mform" role="form">&nbsp;
		<h4 align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Edit Profile</h4>
		<input type="hidden" name="emailid" value="<?php echo $_SESSION['sess_user']; ?>" id="emailid"/>
		<div class="form-group"><label class="col-lg-2 control-label" for="Name">Name</label>
		
		<div class="dropdown col-lg-4"><input type="text" class="form-control" name="username" id="uname" value="<?php echo $uname; ?>" /></div>
		</div>
		&nbsp;<br>
		&nbsp;
		<div class="form-group"><label class="col-lg-2 control-label" for="age">Age</label>
		
		<div class="dropdown col-lg-4"><input type="text" class="form-control" id="age" name="age" value="<?php echo $uage; ?>" /></div>
		</div>
		&nbsp;<br>
		&nbsp;
		
		<div class="form-group"><label class="col-lg-2 control-label" for="phone">Phone</label>
		
		<div class="dropdown col-lg-4"><input type="text" class="form-control" name="phone" id="phone" value="<?php echo $uphone; ?>" /></div>
		</div>
		
		
		<br>
		<br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<input type="submit" align="center" class="btn btn-success" id="submit" type="submit" name="update_user" value="Update" /></form>
		</div>
		</div>
		<!-- NavBar Bottom -->
		
		<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
			<div class="container">
				<p class="navbar-brand col-xs-4">TrekSocial © </p>
				<div class="navbar-text pull-right" float:left="">		
					<a href="https://www.facebook.com/login/" target="blank"><i class="fa fa-facebook-square fa-2x"></i> </a>
					<a href="https://twitter.com/login" target="blank"><i class="fa fa-twitter-square fa-2x"></i> </a>
					<a href="https://plus.google.com/" target="blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
				</div>
			</div>
		</div>
		<!-- NavBar Bottom Ends --><!-- About Us Modal -->
		
		<div class="modal fade" id="AboutUs" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<h4 align="center">About Us</h4>
		</div>
		
		<div class="modal-body">
		<p>We're organising trek and adventure tours</p>
		</div>
		
		<div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="UserPreference.php">OK</a></div>
		</div>
		</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --><!-- Include all compiled plugins (below), or include individual files as needed --><!--<script src="js/bootstrap.min.js"></script> -->
		<script type="text/javascript">
			$(document).ready(function () {
				var validator = $("#Mform").bootstrapValidator({
					feedbackIcons: {
						valid: "glyphicon glyphicon-ok",
						invalid: "glyphicon glyphicon-remove", 
						validating: "glyphicon glyphicon-refresh"
					}, 
					fields : {
						date :{
							validators : {
								notEmpty : {
									message : "Please provide a valid Date"
								}
							 }
					      },
					    gender : {
							validators: {
								notEmpty : {
									message : "gender required"
								}
							 }
					      },
					    transport : {
							validators: {
								notEmpty : {
									message : "required"
								}
							}
						 }
					}
				});
				
			});
		</script>
	
</body>
	
</html>