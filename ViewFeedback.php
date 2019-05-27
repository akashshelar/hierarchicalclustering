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
if(isset($_POST['delete']))
{
	/*echo "<pre>";
	print_r($_POST);
	exit;*/
	
	if($_POST['chk_box'])
	{
		$fids = $_POST['chk_box'];
		$count = count($fids);
		$i = 0;
		foreach($fids as $fid)
		{
			
			$sql = "Delete from write_to_us where write_to_us_id = $fid";
			$exec_sql = mysqli_query($con,$sql);
			if($exec_sql)
			{
				$i++;
			}
		}
		if($count == $i)
		{
			$message = '<div class="alert alert-success fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>Selected group is deleted sucessfully.</strong>
					</div>';
		}
		else
		{
			$message = '<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>Failed to delete the groups.</strong>
					</div>';
		}
	}
}
if(isset($_POST['delete_all']))
{
	/*echo "<pre>";
	print_r($_POST);
	exit;*/
	
	$sql = "delete from write_to_us";
	$exec = mysqli_query($con,$sql);
	if($exec)
	{
		$message = '<div class="alert alert-success fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>All groups are deleted sucessfully.</strong>
					</div>';
	}
	else
	{
		$message = '<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
						<strong>Failed to delete groups.</strong>
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
<style>
.show_menu {
display: block !important;
}
.submenu {
display: none;
}
.table_tag
{
	border:1px solid black; 
	border-radius:10px;
	width:90%;
	margin-bottom:20px;

}
.col-lg-9
{
	margin-bottom:100px;
}
.table_tag th
{
	padding:10px;
	background: #9CA9AD;
}
.table_tag td
{
	border-bottom:1px solid #000;
	padding:10px;
}
.pointer:hover
{
	cursor:pointer;
}
</style>
<script>
$(document).ready(function(e) {
	$("#check_all").change(function () {
		$("input[id='check_boxes']").prop('checked', $(this).prop("checked"));
	});
	$("#delete_all").click(function()
	{
		if(confirm('Are you sure you want to delete ?') == true)
		{
			$('#form').submit();
		}
		else
		{
			return false;
		}
	});
});
function go_back()
{
	window.history.back();
}
function view_feedback()
{
	var count = $("input[id='check_boxes']:checked").length;
	if(count == 0)
	{
		alert('Please select one group.');
	}
	else if(count > 1)
	{
		alert('Please select only one feedback.');
	}
	else
	{
		var val = $("input[id='check_boxes']:checked").val();
		window.location.href = 'ViewFeedbackDetails.php?id='+val;
	}
}
</script>
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
        <!--<li><font color="Blue" font="" size="4"><a href="Suggestdestination.php" target="_top">Suggest New Destinations</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="feedback.php" target="_top">Write to us</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="Settings.php" target="_top">Settings</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="#" target="_top">Security</a></font></li>
            <li><font color="Blue" font="" size="4"><a href="#" target="_top">Help</a></font></li>-->
        </ul>
  </div>
    </div>
<div class="container col-lg-9">
<div class="panel-body">
<?php if($message != ''){?> 
<center><?php echo $message; ?></center>
<?php } ?>
<form method="post" action="" id="form" name="fb_form" enctype="multipart/form-data">
<center><h4>Feedbacks</h4></center>
<table class="table_tag">
<tr>
<th><input type="checkbox" value="all" name="all" id="check_all"></th><th>Subject</th><th>Content</th><th>User Name</th><th>Email ID</th>
</tr>
<?php 
$sql = "select f.write_to_us_id id,f.subject,f.comment,f.email_id,u.name from write_to_us f
		left join signlog u on u.email = f.email_id"; 
$sql_exec = mysqli_query($con, $sql);
if($sql_exec->num_rows > 0){
while($row = $sql_exec->fetch_assoc())
{ if($row['name'] != '') { ?>
<tr>
	<td><input type="checkbox" name="chk_box[]" value="<?php echo $row['id']; ?>" id="check_boxes"></td>
    <td><?php echo $row['subject']; ?></td>
    <td><?php echo $row['comment']; ?></td>
    <td><?php echo $row['email_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
</tr>
<?php } } }
else {
?>
<tr>
<td colspan="5"><strong>No Feedback(s) found</strong></td>
</tr>
<?php } ?>
</table>
<div align="center">
<input align="center" class="btn btn-success" name="view" onclick='view_feedback();' id="view" type="button" value="View">
<input align="center" class="btn btn-success" name="delete" id="delete" type="submit" value="Delete">
<input align="center" class="btn btn-success" name="delete_all" id="delete_all" type="submit" value="Delete All">
<input align="center" class="btn btn-success" onClick="go_back();" name="back" id="back" type="button" value="Back">
</div>
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