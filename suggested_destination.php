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
$msg='';

if(isset($_POST['delete'])){
	if(isset($_POST['select'])){
		$selids  = implode(',',$_POST['select']);
		
		$str = "delete from destinations where dest_id in ($selids)";
		$res = mysqli_query($con,$str);
		if($res){
			$msg = "Selected Groups are deleted...";	
		}	
	}	
}
if(isset($_POST['deleteall'])){
	if(isset($_POST['alldest'])){
		$selids  = implode(',',$_POST['alldest']);
		
		$str = "delete from destinations where dest_id in ($selids)";
		$res = mysqli_query($con,$str);
		if($res){
			$msg = "All Groups are deleted...";	
		}	
	}	
}

if(isset($_POST['view']))
{
	if(count($_POST['select'])==1){
		$selids  = implode(',',$_POST['select']);
	
	}
	else{
		$msg = "Select only one group for view group details.";	
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
.col-lg-9{margin-bottom:100px;}
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
        </ul>
  </div>
    </div>
<div class="container col-lg-9">
      <div class="panel-body">
      <?php if($message != "") { ?>
      <span style="color:#C00; text-align:center;"><?php echo $message; ?></span>
      <?php } ?>
    	<form action="" id="Mform" class="form_rightl" method="POST" enctype="multipart/form-data">
          &nbsp;
          <h4 align="left">Suggested Destination</h4>
          	<span style="color:#FF0000"><?php echo $msg; ?></span>
          	<div class="form-group">
       			<table class="table_tag">
                	<tr>
                    	<th></th>
                        <th>Destination Name</th>
                        <th>District</th>
                        <th>Height</th>
                        <th>Difficulty Level</th>
                        <th>Endurance Level</th>
                        
                    </tr>
                    <?php
						$str = "select distinct(g.dest_id),g.destination_name as dname,g.difficulty,g.endurance,g.district,g.height from destinations g where g.is_Active=1 order by g.dest_id";
						$result = mysqli_query($con,$str);
/*						echo '<pre>';
						print_r($result); exit;
*/						while($row=mysqli_fetch_array($result))
						{
							?>
                            <tr>
                            	<td><input type="checkbox" name="select[]" value="<?php echo $row['dest_id'];?>"><input type="hidden" name="alldest[]" value="<?php echo $row['dest_id'];?>" /></td>
                                <td><?php echo $row['dname']; ?></td>
                                <td><?php echo $row['district']; ?></td>
                                <td><?php echo $row['height']; ?></td>
                                <td><?php echo $row['difficulty']; ?></td>
                                <td><?php echo $row['endurance']; ?></td>
                            </tr>
                            <?php
						}
					?>
                </table>
                	<input align="center" class="btn btn-success" name="view" id="view" type="button" value="View">
                    <input align="center" class="btn btn-success" name="delete" id="delete" type="submit" value="Delete">
                    <input align="center" class="btn btn-success" name="deleteall" id="deleteall" type="submit" value="Delete All">
                    <input align="center" class="btn btn-success" name="back" onClick="history.go(-1);" id="back" type="button" value="Back">
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