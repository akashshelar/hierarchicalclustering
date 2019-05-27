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
if(isset($_POST['leave_group']))
{
	if(isset($_REQUEST['email'])){$email = $_REQUEST['email'];}else{$email = '';};
	if(isset($_REQUEST['group_id'])){$g_id = $_REQUEST['group_id'];}else{$g_id = '';};
	
	$sql = "Select gp.groups_preference_id as gid from groups_preference gp
			left join preference p on p.preference_id = gp.preference_id
			where p.email = '".$email."' and gp.groups_id = $g_id";
	//exit($sql);
	$resgid = $con->query($sql);
	//$rowgid = $resgid->fetch_array(MYSQLI_ASSOC);
	while($rowd = $resgid->fetch_assoc()) 
	{
		$updp = "update groups_preference set is_left = 1 where groups_preference_id = '".$rowd['gid']."'";
		$resupdp = $con->query($updp);
		if($resupdp)
		{
			header('Location:Groups.php?left=1');
		}
		else
		{
			$message = "Failed to leave a group.";	
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
<style>
.col-lg-9
{
	margin-bottom:100px;
}
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
<div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button><img class="img-rounded" src="img/TrekSocial_Trial.jpg" /></div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-left">
	<li><a href="index.php">Home</a></li>
	<li><a data-toggle="modal" href="#AboutUs">About Us</a></li>
	<li><a href="logout.php">Log Out</a></li>
</ul>
</div>
</div>
</div>
<!-- NavBar Top Ends -->
<div style="height:100%;">
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

<div class="col-lg-9">
<center><strong>Group Details</strong></center>
<div class="panel-body">
<?php
$group_id = $_GET["id"];
$sql = "SELECT distinct(g.group_id) as gid,g.destination as dest,g.date as cdate,g.contact as cnum  ,g.result as res,
			p.gender, p.trek_type,p.district as p_dist,p.month
			FROM groups g 
			LEFT JOIN groups_preference gp ON g.group_id = gp.groups_id 
			LEFT JOIN preference p ON p.preference_id = gp.preference_id 
			WHERE p.email =  '".$_SESSION['sess_user']."' and g.group_id = $group_id";

$result = $con->query($sql);
if ($result->num_rows > 0) 
{
	$i=0;
	while($row = $result->fetch_assoc()) 
	{
		$sqld = "SELECT *
				FROM signlog s
				LEFT JOIN preference p ON s.email = p.email
				LEFT JOIN groups_preference gp ON gp.preference_id = p.preference_id
				LEFT JOIN groups g ON g.group_id = gp.groups_id
				where gp.groups_id =  '".$group_id."' 
				AND g.destination = '".$row["dest"]."'";
	
		$sqld_exec = $con->query($sqld);
		$end_level = 0;
		$diff_level = 0;
		while($rowd = $sqld_exec->fetch_assoc()) 
		{
			$end_level = $end_level+$rowd['endurance'];
			$diff_level = $diff_level+$rowd['difficulty'];
		}
		$end_level = round($end_level/$sqld_exec->num_rows);
		$diff_level = round($diff_level/$sqld_exec->num_rows);
		
		
		$sqlg = "select s.name,s.age,s.gender u_gender,s.email u_mail,
							p.preference_id,p.city,p.district,p.difficulty,p.endurance,p.month,p.trek_type,p.email p_mail,p.gender p_gender,
							gp.groups_preference_id,gp.groups_id,gp.groups_id,gp.is_left
							from signlog s 
							left join preference p on s.email=p.email 
							left join groups_preference gp on gp.preference_id = p.preference_id 
							where gp.groups_id = '".$group_id."' and gp.is_left = 0 and gp.is_left = 0";
		$resultg = $con->query($sqlg);
		if ($resultg->num_rows > 0)
		{
			$date 		 = $row["cdate"];
		?>
        <table class="table_tag">
            <tr>
                <td>Destination : </td><td>
                <?php 
				$dest_sql = "SELECT * 
							FROM destinations
							WHERE endurance = $end_level
							AND difficulty = $diff_level
							AND district =  '".$row["p_dist"]."' and is_active = 0"; 
				
				$dest_exec = $con->query($dest_sql);
				if($dest_exec->num_rows > 0)
				{
					while($des_loop = $dest_exec->fetch_assoc()) 
					{
						echo $des_loop['destination_name'];
					}	
				}
				else
				{
					echo "Pratapgad Fort";
				}
				?>
                </td>
            </tr>
            <tr>
                <td>City : </td><td><?php echo $row["dest"]; ?></td>
            </tr>
            <tr>
                <td>Month : </td><td><?php echo $row['month']; ?></td>
            </tr>
            <tr>
                <td>Group Type : </td><td><?php echo $row['gender']; ?></td>
            </tr>
            <tr>
                <td>Trek Type : </td><td><?php echo $row['trek_type']; ?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><b>Group Member(s)</b></td>
            </tr>
            <tr>
            <td colspan="2">
            <table align="center" class="table_tag">
            	<tr>
                    <th>Gender</th><th>Name</th><th>Email</th><th>Age</th>
                </tr>
                
                    <?php 
                    while($rowg = $resultg->fetch_assoc()) 
                    {
                        //$memberarr[] 	= $rowg['name'];
                        //$trektype		= $rowg['trek_type'];
                        //$grptype		= $rowg['gender'];
                        ?>
                        <tr>
                        <td><?php echo $rowg['u_gender']; ?></td><td><?php echo $rowg['name']; ?></td><td><?php echo $rowg['u_mail']; ?></td><td><?php echo $rowg['age']; ?></td>
	                    </tr>
                    <?php 
				}
				?>
          </table>
          </td>
          </tr>
          <form method="post" action="" enctype="multipart/form-data">
          <tr>
          	<input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
            <input type="hidden" name="email" value="<?php echo $_SESSION['sess_user']; ?>">
          	<td colspan="2" align="center"><input type="submit" class="btn btn-danger" name="leave_group" value="Leave Group"></td>
          </tr>
          </form>
        </table>
<?php 
		}
	}
} 
?>
</div>
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