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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	<meta content="width=device-width, initial-scale=1" name="viewport" /><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trek Social</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" /><!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/custom.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /><!-- BootstrapValidator CSS -->
	<link href="css/bootstrapValidator.min.css" rel="stylesheet" /><!-- jQuery and Bootstrap JS --><script src="js/jquery.min.js" type="text/javascript"></script><script src="js/bootstrap.min.js" type="text/javascript"></script><!-- BootstrapValidator --><script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
</head>
<body><!-- NavBar Top Begins -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container clearfix">
<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><img class="img-rounded" src="img/TrekSocial_Trial.jpg" /></div>

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

<div class="col-lg-2">
<div class="jumbotron">
<ul type="square">
	<li><font color="Blue" font="" size="4"><a href="UserPreference.php" target="_top">Set Preferences</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Editprofile.php" target="_top">Edit Profile</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="ViewDestinations.php" target="_top">View destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Groups.php" target="_top">View your groups</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Rate_Review.php" target="_top">Rate and Review Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Suggestdestination.php" target="_top">Suggest New Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="feedback.php" target="_top">Write to us</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Settings.php" target="_top">Settings</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="#" target="_top">Security</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="#" target="_top">Help</a></font></li>
</ul>
</div>
</div>

<div class="container">
<div class="panel-body">
<form action="#login.php" class="form_rightl" method="POST" name="Mform" role="form">&nbsp;
<h4 align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Select Trek</h4>
&nbsp;

<div class="form-group"><label class="col-lg-2 control-label" for="toptreks">Suitable treks for you</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" id="toptrekss"><option selected="selected" value="Sinhagad, 23rd March 2016">Sinhagad, 23rd March 2016</option><option value="Ratandard, 25th March 2016">Ratangad, 25th March 2016</option><option value="Rajgad, 28th March 2016">Rajgad, 28th March 2016</option> </select></div>
</div>
<br />
<br />
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<button align="center" class="btn btn-success" id="submit" type="submit">Select Trek</button></form>
</div>
</div>
<!-- NavBar Bottom -->

<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
<div class="container">
<p class="navbar-brand col-xs-4">TrekSocial &copy;</p>

<div class="navbar-text pull-right" float:left=""></div>
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
<p>We&#39;re organising trek and adventure tours</p>
</div>

<div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="SelectTrek.php">OK</a></div>
</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --><!-- Include all compiled plugins (below), or include individual files as needed --><!--<script src="js/bootstrap.min.js"></script> --></body>
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
</script></html>