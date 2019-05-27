<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
	die("connection failed" . mysqli_error($con));
}
if(!isset($_SESSION['sess_admin']) && $_SESSION['sess_admin'] == "")
{
	header('Location:index.php');
}
$message = '';
if(isset($_POST['Save']))
{
	/*echo "<pre>";
	print_r($_POST);*/
	
	$sql = "UPDATE destinations set difficulty = '".$_POST['trekDifficulty']."', endurance = '".$_POST['endurance']."', height = '".$_POST['height']."',
			district = '".$_POST['dist_name']."' where destination_name = '".$_POST['dest_name']."'";
	$exec = mysqli_query($con,$sql);
	if($exec == true)
	{
		$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						Destination "'.$_POST['dest_name'].'" is updated.
					</div>';
	}
	else
	{
		$message = '<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						Failed to update destination "'.$_POST['dest_name'].'".
					</div>';
	}
	
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Trek Social</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
	<!-- Bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet" />
	<link href="../css/custom.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	<!-- BootstrapValidator CSS -->
	<link href="../css/bootstrapValidator.min.css" rel="stylesheet" />
	<!-- jQuery and Bootstrap JS -->
	<script src="../js/jquery.min.js" type="text/javascript"></script><script src="../js/bootstrap.min.js" type="text/javascript"></script><!-- BootstrapValidator -->
	<script src="../js/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
	function get_destination()
	{
		var id = document.getElementById('dest_id').value;
		if(id != 0)
		{
			jQuery.ajax({
				url: "rpc/rpc_getDestinationForm.php?dest="+id,
				type: 'GET',
				success: function(data)
				{
					jQuery('#destination_details').html(data);
				},
				error:function(data)
				{
					console.log('Error');
				}
			});
		}
		else
		{
			jQuery('#destination_details').html('');
		}
	}
	</script>
	<style>
.show_menu {
	display: block !important;
}
.submenu {
	display: none;
}
</style>
	</head>
	<body>
<!-- NavBar Top Begins -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container clearfix">
    <div class="navbar-header">
          <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button>
          <img class="img-rounded" src="../img/TrekSocial_Trial.jpg" /></div>
    <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
        <li><a href="MainMenu.php">Home</a></li>
        <li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
        </div>
  </div>
    </div>
<!-- NavBar Top Ends -->

<div class="col-lg-3">
      <div class="jumbotron">
    <ul type="square">
          <li onclick='openDropDown()'><font color="Blue" font="" size="4"><a href="javascript:void(0);" target="_top">Edit Destinations</a></font>
        <ul id='drpdwn' class='submenu'>
              <li><font color="Blue" font="" size="4"><a href="AddDestination.php" target="_top">Add Destination</a></font></li>
              <li><font color="Blue" font="" size="4"><a href="DeleteDestination.php" target="_top">Delete Destination</a></font></li>
              <li><font color="Blue" font="" size="4"><a href="UpdateDestination.php" target="_top">Update Destination</a></font></li>
            </ul>
      </li>
          <li><font color="Blue" font="" size="4"><a href="EditGrooup.php" target="_top">Edit Groups</a></font></li>
      <li><font color="Blue" font="" size="4"><a href="ViewFeedback.php" target="_top">View Feedback</a></font></li>
      <li><font color="Blue" font="" size="4"><a href="suggested_destination.php" target="_top">View suggested destinatios</a></font></li>
          <!--<li><font color="Blue" font="" size="4"><a href="Suggestdestination.html" target="_top">Suggest New Destinations</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="feedback.html" target="_top">Write to us</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="Settings.html" target="_top">Settings</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="#" target="_top">Security</a></font></li>
	<li><font color="Blue" font="" size="4"><a href="#" target="_top">Help</a></font></li>-->
        </ul>
  </div>
    </div>
<div class="container col-lg-8">
      <div class="panel-body">
      <?php if($message != '')
	  { ?>
		<center><?php echo $message; ?></center>
      <?php } ?>
    	<form action="" id="Mform" class="form_rightl" method="POST" enctype="multipart/form-data">
          &nbsp;
          <h4 align="left"><center>Update Destination</center></h4>
        <?php
		
		$sql = "select * from destinations where is_active = 0 ORDER BY DESTINATION_NAME";
		$exec = mysqli_query($con,$sql);
		?>
        <div class="form-group">
        <label class="col-lg-3 control-label" for="sel_dest">Destination Name</label>
        <div class="dropdown col-lg-4">
        <select name="dest_name" class="form-control" id="dest_id" onChange="get_destination()">
        <option value="0">Select destination</option>
        <?php
		while($row = $exec->fetch_assoc())
		{
			echo '<option value="'.$row['destination_name'].'">'.$row['destination_name'].'</option>';
		}
		
		?>
        </select>
        </div>
        </div>&nbsp;<br />&nbsp;
        <div id="destination_details"></div>
        </form>
  </div>
    </div>
<!-- NavBar Bottom -->

<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
      <div class="container">
    <p class="navbar-brand col-xs-4">TrekSocial &copy </p>
    <div class="navbar-text pull-right" float:left> <a href="https://www.facebook.com/login/" target="blank"><i class="fa fa-facebook-square fa-2x"></i> </a> <a href="https://twitter.com/login" target="blank"><i class="fa fa-twitter-square fa-2x"></i> </a> <a href="https://plus.google.com/" target="blank"><i class="fa fa-google-plus-square fa-2x"></i></a> </div>
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
          <div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="MainMenu.php">OK</a></div>
        </div>
  </div>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --><!-- Include all compiled plugins (below), or include individual files as needed --><!--<script src="js/bootstrap.min.js"></script> -->
</body>
<script type="text/javascript">
	$(document).ready(function () {
		var james = $("#Mform").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok",
				invalid: "glyphicon glyphicon-remove", 
				validating: "glyphicon glyphicon-refresh"
			}, 
			fields : {
				dest_name: {
					validators : {
						notEmpty : {
						message:"Name required"
					     },
						 stringLength : {
							min: 4,
							max: 85,
							message: "Enter Name"
						}
					}
				},				
				dist_name : {
				  validators : {
					notEmpty : {
					message:"District required"
					},
					stringLength : {
							min: 4,
							max: 85,
							message: "Enter District"
						}
					 }
				},
				trekDifficulty : {
				  validators : {
					notEmpty : {
					    message:"Please select Difficulty Level"
					  }
				   }
				},
				endurance :{
					message : "Endurance level required.",
					validators : {
						notEmpty : {
							message : "Please select Endurance Level."
						}
					}
				}, 
				height : {
					validators: {
						digits: {
                        message: 'The phone number can contain digits only'
                    	},
						notEmpty : {
							message : "Please Enter Height"
						}
					}
				}
			}
		});
		
	});
function openDropDown()
{
	$('#drpdwn').toggleClass('show_menu');
} 
</script>
</html>