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
$message = '';
if(isset($_POST['submit']))
{
	/*echo "<pre>";
	print_r($_POST);
	echo $_POST['option'];
	echo $_POST['comment'];
	exit;*/
	
	if($_POST['option'] != 'select' &&$_POST['comment'] != '')
	{
		$sql = "INSERT INTO write_to_us (email_id,subject,comment) VALUES ('".$_SESSION['sess_user']."','".$_POST['option']."','".$_POST['comment']."') ";
		$exec = mysqli_query($con,$sql);
		if($exec)
		{
			$message = '<div class="alert alert-success fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>Your feedback sent successfully.</strong>
						</div>';
		}
	}
	else
	{
		$message = '<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>Please Fill up required fields.</strong>
					</div>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Trek Social</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	 <!-- BootstrapValidator CSS -->
      <link href="css/bootstrapValidator.min.css" rel="stylesheet"/>
	
    <!-- jQuery and Bootstrap JS -->
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
		
    <!-- BootstrapValidator -->
    <script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>
  </head>

<body>
  
<!-- NavBar Top Begins -->
    <div class="navbar navbar-inverse navbar-fixed-top"role="navigation">
		<div class="container clearfix">
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			    </button>
		        <img src="img/TrekSocial_Trial.jpg" class="img-rounded" />
			</div>

					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-left">
						    	<li><a href="index.php">Home</a></li>
						    	<li><a href="#AboutUs" data-toggle="modal">About Us</a></li>
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
<?php if($message != '') { ?>
<center><?php echo $message; ?></center>
<?php } ?>
	<form name="Mform" method="POST"  action="" enctype="multipart/form-data" class="form_rightl" role="form" >
	&nbsp;
	<h4 align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Write to us </h4>
	<br />
	  		<div class="form-group" >
	    				<label for="inputSubject" class="col-lg-2 control-label">Subject</label>
						
						<div class="dropdown col-sm-4">
	    						<select name="option" id="city" class="form-control" autocomplete="off">
								<option value="select" selected>Select Option</option>
								<option value="TrekApp">Trek Application</option>
								<option value="TrekExp">Trek Experience</option>
								<option value="Other">Other</option>
							</select>	    						
					</div>
			</div>
<br />			
<br />

			<div class="form-group" >
	    				<label for="trekExp" class="col-lg-2 control-label">Content</label>
						
						<div class="col-lg-4">
	    				<textarea name="comment" class="form-control" id="Review" autocomplete="off" style="resize:none"></textarea>	    						
						</div>
			</div>				

<br />
<br />				
<br />	
<br />	
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<button type="submit" align="center" name="submit" class="btn btn-success"  id="submit">Submit</button>
</form>
    </div>
</div>



<!-- NavBar Bottom -->
<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
	<div class="container">
		<p class="navbar-brand col-xs-4">TrekSocial &copy </p>
		<div class="navbar-text pull-right" float:left>		
			<a href="https://www.facebook.com/login/" target="blank"><i class="fa fa-facebook-square fa-2x"></i> </a>
			<a href="https://twitter.com/login" target="blank"><i class="fa fa-twitter-square fa-2x"></i> </a>
			<a href="https://plus.google.com/" target="blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
		</div>
	</div>
</div>
<!-- NavBar Bottom Ends -->

<!-- About Us Modal -->
<div class="modal fade" id="AboutUs" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		
		     <div class="modal-header">
		     <h4 align="center">About Us</h4>
		     </div>
				
				<div class="modal-body">
				<p>We're organising trek and adventure tours</p>
				</div>
		     		
			<div class="modal-footer">
		    <a href="UserPreference.php" class="btn btn-success" data-dimiss="modal">OK</a>
		    </div>
		</div>
	</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="js/bootstrap.min.js"></script> -->
  </body>
</html>