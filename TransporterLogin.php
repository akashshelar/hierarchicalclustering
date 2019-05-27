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
	<title>TrekSocial</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" /><!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/custom.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /><!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container clearfix">
<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><a href="index.php"><img class="img-rounded" src="img/TrekSocial_Trial.jpg"/></a></div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-left">
	<li class="active"><a href="index.php">Home</a></li>
	<li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
</ul>
</div>
</div>
</div>

<div class="container">
<div class="jumbotron text-center">
<h1>TrekSocial</h1>

<p>Register with us and help with transportation</p>
<a class="btn btn-success" data-toggle="modal" href="#TransporterLogin">Login</a> <a class="btn btn-success" data-toggle="modal" href="#TransporterSignUp">SignUp</a></div>
</div>

<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
<div class="container">
<p class="navbar-brand col-xs-4">TrekSocial &copy;</p>

<div class="navbar-text pull-right" float:left=""></div>
</div>
</div>

<div class="modal fade" id="AboutUs" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 align="center">About Us</h4>
</div>

<div class="modal-body">
<p>We are organising trek and adventure tours</p>
</div>

</div>
</div>
</div>
<!-- Login Modal Begins -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="TransporterLogin" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center" class="modal-title" id="LoginLabel">Login</h4>
</div>
<!--Login Form Code Begins -->

<div class="modal-body">
<form action="login.php" class="form-horizontal" id="login" method="POST" role="form">&nbsp;
<div class="form-group"><label class="col-sm-2 control-label" for="inputRegistration">Username</label>

<div class="col-sm-8"><input class="form-control" name="uname" placeholder="Enter Your Username" type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="inputLicense">Password</label>

<div class="col-sm-8"><input class="form-control" name="password" placeholder="Enter Your Password" type="password" /></div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-8">
<div class="checkbox"><label><input type="checkbox" /> Remember me </label></div>
</div>
</div>
<!--		<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
      				<button type="submit" class="btn btn-success">Sign in</button>
    				</div>
  			</div>    --></form>
</div>
<!--Login Form Code Ends -->

<div class="modal-footer"><button class="btn btn-success" type="submit">Login</button><!--		<a class="btn btn-success" data-dimiss="modal">Login</a>    --></div>
</div>
</div>
</div>
<!--Login Form Modal Ends --><!--SignUp Form Modal begins -->

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="TransporterSignUp" role="dialog" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header"><button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>

<h4 align="center" class="modal-title" id="SignUpLabel">SignUp</h4>
</div>
<!--SignUp Form begins -->

<div class="modal-body">
<form action="transp.php" class="form-horizontal" id="signup" method="POST" role="form">
<div class="form-group"><label class="col-sm-2 control-label" for="inputName">Name</label>

<div class="col-sm-10"><input class="form-control" name="name" placeholder="Your Name" required="" type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="inputVehicle">Email</label>

<div class="col-sm-10"><input class="form-control" name="email" placeholder="Your Email ID" type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="inputLicense">Contact No.</label>

<div class="col-sm-10"><input class="form-control" name="contact" placeholder="Your Contact No." type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="confirmLicense">City</label>

<div class="col-sm-10"><input class="form-control" name="city" placeholder="Your City" type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="inputPhone">License Number</label>

<div class="col-sm-10"><input class="form-control" name="license" placeholder="Your License Number" type="text" /></div>
</div>

<div class="form-group"><label class="col-sm-2 control-label" for="inputPhone">Vehicle Registration No</label>

<div class="col-sm-10"><input class="form-control" name="vehicle_reg" placeholder="Vehicle Registration Number" type="text" /></div>
</div>
</form>
</div>
<!--SignUp Form ends -->

<div class="modal-footer"><button class="btn btn-success" id="submit" type="submit">SignUp</button><!--		<a class="btn btn-success" data-dimiss="modal">SignUp</a>    --></div>
</div>
</div>
</div>
<!--SignUp Form Modal ends --><!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Include all compiled plugins (below), or include individual files as needed --><script src="js/bootstrap.min.js"></script></body>
</html>