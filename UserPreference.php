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

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$city=mysqli_real_escape_string($con,$_POST['city']);
	$district=mysqli_real_escape_string($con,$_POST['district']);
	$difficulty=mysqli_real_escape_string($con,$_POST['difficulty']);
	$endurance=mysqli_real_escape_string($con,$_POST['endurance']);
	$month=mysqli_real_escape_string($con,$_POST['month']);
	$trek_type=mysqli_real_escape_string($con,$_POST['trek_type']);
	$gender=mysqli_real_escape_string($con,$_POST['gender']);
	$email = $_SESSION['sess_user'];
	$sql = "INSERT INTO preference(city,district,difficulty,endurance,month,trek_type,gender,email)VALUES ('$city','$district','$difficulty','$endurance','$month','$trek_type','$gender','".$email."')";
	
		if(!mysqli_query($con,$sql))
		{	
			die('error:'.mysqli_error($con));
		}
		else
		{
			$sql_max = "select max(preference_id) as maxid from preference where city='".$city."' and district='".$district."' and difficulty='".$difficulty."' and endurance='".$endurance."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$gender."'";
			
			$result1 = $con->query($sql_max);
			$row1 = $result1->fetch_array(MYSQLI_ASSOC);
			$maxid = $row1['maxid'];
			
			
			/*----- check in preference table for same data ------*/
			$sql_check = "select preference_id as pid from preference where district='".$district."' and month='".$month."' and trek_type='".$trek_type."' and gender='".$gender."' AND preference_id NOT IN ( '".$maxid."' )" ; 
			
			$result = $con->query($sql_check);
			$pre_id_arr = array();
			while($rown = $result->fetch_array()){					
					$pre_id_arr[] = $rown['pid'];
			}
			$pre_ids = implode(',',$pre_id_arr);
			$counts = $result->num_rows;
			
			if($counts>0){
				
				/*---- count group_preference table for same preference_id ----*/
				 $sql_gp = "select groups_id from groups_preference where preference_id in ('".$pre_ids."')";
				
				$result2 = $con->query($sql_gp);
				$row2 = $result2->fetch_array(MYSQLI_ASSOC);
				
				$countgp = $result2->num_rows;
				if($countgp==0)
				{
					$sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
					if ($con->query($sql_newg) === TRUE) {
						$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";

						$resmaxgid = $con->query($getmaxgid);
						$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
						$maxgid = $rowmgid['maxgid'];

						$insgp = "insert into groups_preference(group_id,preference_id) values ('".$maxgid."','".$maxid."')";
						$resgp = $con->query($insgp);
						/*---------------------------------------------------------------------------------------------------------------------------*/
						$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."'  ";
						$rescntstr = $con->query($strcnt);
						$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
						$cnt = $rowcnt['cnt'];
						
						if($cnt > 3 ){
							$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
							$resupdp = $con->query($updp);
						}
						/*---------------------------------------------------------------------------------------------------------------------------*/
						if($insgp)
						{
							$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
											Preferences Set successfully.
										</div>';
						}
						else
						{
							$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
											Failed to set preference.
										</div>';
						}
					}
				}
				else{
					$gpid = $row2['groups_id'];
					
					$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$gpid."','".$maxid."')";
					$resgp = $con->query($insgp);
					
					/*---------------------------------------------------------------------------------------------------------------------------*/
					$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$gpid."'  ";
					$rescntstr = $con->query($strcnt);
					$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
					$cnt = $rowcnt['cnt'];
					
					if($cnt > 3 ){
						$updp = "update groups set is_active=1 where group_id = '".$gpid."'";
						$resupdp = $con->query($updp);
					}
					/*---------------------------------------------------------------------------------------------------------------------------*/
					if($insgp)
					{
						$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										Preferences Set successfully.
									</div>';
					}
					else
					{
						$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										Failed to set preference.
									</div>';
					}				
				}
			}
			else{
				 $sql_newg = "insert into groups(destination,date,result,email_id) values ('".$city."',CURDATE(),'pending','".$email."')";
				if ($con->query($sql_newg) === TRUE) {
					$getmaxgid = "select max(group_id) as maxgid from groups where destination='".$city."'";

					$resmaxgid = $con->query($getmaxgid);
					$rowmgid = $resmaxgid->fetch_array(MYSQLI_ASSOC);
					$maxgid = $rowmgid['maxgid'];

					$insgp = "insert into groups_preference(groups_id,preference_id) values ('".$maxgid."','".$maxid."')"; 
					$resgp = $con->query($insgp);
					/*---------------------------------------------------------------------------------------------------------------------------*/
					$strcnt = "select count(*) as cnt from groups_preference where groups_id = '".$maxgid."' ";
					$rescntstr = $con->query($strcnt);
					$rowcnt = $rescntstr->fetch_array(MYSQLI_ASSOC);
					$cnt = $rowcnt['cnt'];
					
					if($cnt > 3 ){
						$updp = "update groups set is_active=1 where group_id = '".$maxgid."'";
						$resupdp = $con->query($updp);
					}
					/*---------------------------------------------------------------------------------------------------------------------------*/
					if($insgp)
					{
						$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										Preferences Set successfully.
									</div>';
					}
					else
					{
						$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										Failed to set preference.
									</div>';
					}
				}
			}
		}
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
	<link href="css/bootstrapValidator.min.css" rel="stylesheet" /><!-- jQuery and Bootstrap JS --><script src="js/jquery.min.js" type="text/javascript"></script><script src="js/bootstrap.min.js" type="text/javascript"></script><!-- BootstrapValidator --><script src="js/bootstrapValidator.min.js" type="text/javascript"></script><script src="js/custom.js" type="text/javascript"></script>
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

<div class="container col-lg-9">
<?php if($message != '')
{ ?>
<center><?php echo $message; ?></center>
<?php } ?>
<form action="" class="form_rightl" method="POST" name="Mform" role="form">&nbsp;
<h4 align="left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Set Preferences</h4>

<div class="form-group"><label class="col-lg-2 control-label" for="City">Your city</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="city"><option selected="selected">Select City</option><option name="Pune">Pune</option><option name="Mumbai">Mumbai</option><option name="Nashik">Nashik</option> </select></div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group"><label class="col-lg-2 control-label" for="trekRegion">Trek District</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="district"><option selected="selected">Select District</option><option name="Ahmednagar">Ahmednagar</option><option name="Kolhapur">Kolhapur</option><option name="Nashik">Nashik</option><option name="Pune">Pune</option><option name="Raigad">Raigad</option><option name="Satara">Satara</option> </select></div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group"><label class="col-lg-2 control-label" for="trekDifficulty">Your preferred Difficulty level</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="difficulty"><option selected="selected">Select difficulty level</option><option name="1">1</option><option name="2">2</option><option name="3">3</option><option name="4">4</option><option name="5">5</option> </select></div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group"><label class="col-lg-2 control-label" for="trekEndurance">Your preferred Endurance level</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="endurance"><option selected="selected">Select endurance level</option><option name="1">1</option><option name="2">2</option><option name="3">3</option><option name="4">4</option><option name="5">5</option> </select></div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group"><label class="col-lg-2 control-label" for="inputMonth">Choose Month</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="month"><option selected="selected">Select Month</option><option name="January">January</option><option name="February">February</option><option name="March">March</option><option name="April">April</option><option name="May">May</option><option name="June">June</option><option name="July">July</option><option name="August">August</option><option name="September">September</option><option name="October">October</option><option name="November">November</option><option name="December">December</option> </select></div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group"><label class="col-lg-2 control-label" for="trekType">Type of trek</label>

<div class="dropdown col-lg-4"><select autocomplete="off" class="form-control" name="trek_type"><option selected="selected">Select Type of trek</option><option name="One Day trek">One Day trek</option><option name="Weekend trek">Weekend trek</option> </select></div>
</div>
&nbsp;<br />
&nbsp; 
<div class="form-group"><label class="col-lg-2 control-label" for="inputGender"> Type of Group</label>

<div class="col-lg-6"><input name="gender" type="radio" value="Male" />Only Male &nbsp; &nbsp; &nbsp; <input name="gender" type="radio" value="Female" />Only Female &nbsp; &nbsp; &nbsp; <input name="gender" type="radio" value="Unisex" />UniSex</div>
</div>
<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;<button align="center" class="btn btn-success" id="submit" type="submit">Submit</button></form>

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

<div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="UserPreference.php">OK</a></div>
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