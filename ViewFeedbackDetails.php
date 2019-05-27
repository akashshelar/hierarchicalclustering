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
$feedid = $_GET['id'];

if(isset($_POST['delete']))
{	
	$sql = "delete from write_to_us where write_to_us_id = '".$_POST['f_id']."'";
	$sql_exec = mysqli_query($con,$sql);
	echo 	"<script>
			window.location.href = 'ViewFeedback.php';
			</script>";
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
    <script type="text/javascript">
$(document).ready(function(e) {
	$("#delete").click(function () {
		if(confirm('Do you want to delete this Feedback ?') == true)
		{
			$('#form').submit();
		}
		else
		{
			return false;
		}
	});
});
    </script>
<style>
.table_tag
{
	border:1px solid black; 
	border-radius:10px;
	width:90%;
}
.table_tag th
{
	padding:10px;
	background: #9CA9AD;
}
.table_tag td
{
	padding:10px;
}
</style>

</head>
<body><!-- NavBar Top Begins -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container clearfix">
<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><img class="img-rounded" src="../img/TrekSocial_Trial.jpg" /></div>

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
<div style="height:100%;">

<style>
.show_menu {
display: block !important;
}
.submenu {
display: none;
}
</style><div class="col-lg-3">
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
          <li><font color="Blue" font="" size="4"><a href="Suggesions.php" target="_top">View suggested destinatios</a></font></li>
        </ul>
  </div>
    </div>

<div class="col-lg-9">
<center><strong>Feedback details</strong></center>
<?php
$sql = "select f.write_to_us_id id,f.subject,f.comment,f.email_id,u.name from write_to_us f
		left join signlog u on u.email = f.email_id 
		Where f.write_to_us_id = $feedid"; 
$sql_exec = mysqli_query($con, $sql);
if($sql_exec->num_rows > 0){
while($row = $sql_exec->fetch_assoc()) {
?>
<form method="POST" action="" enctype="multipart/form-data" id="form">
<table class="table_tag">
<tbody>
<tr>
<td>User's Name : </td><td><?php echo $row['name']; ?></td>
</tr>
<tr>
<td>User's Email : </td><td><?php echo $row['email_id']; ?></td>
</tr>
<tr>
<td>Subject : </td><td><?php echo $row['subject']; ?></td>
</tr>
<tr>
<td colspan="2">Content : </td>
</tr>
<tr>
<td colspan="2"><textarea style="width:100%;" disabled><?php echo $row['comment']; ?></textarea></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="button" onclick="history.go(-1);" class="btn btn-success" name="ok" value="OK">&nbsp;&nbsp;&nbsp;&nbsp;
<input align="center" class="btn btn-danger" name="delete" id="delete" type="submit" value="Delete"></td>

</tr>
</tbody>
</table>
<input type="hidden" value="<?php echo $feedid; ?>" name="f_id">
</form>
<?php } } ?>
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

<div class="modal-footer"><a class="btn btn-success" data-dimiss="modal" href="Groups.php">OK</a></div>
</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --><!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --><!-- Include all compiled plugins (below), or include individual files as needed --><!--<script src="js/bootstrap.min.js"></script> --></body>
<script type="text/javascript">

</script></html>