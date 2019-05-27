<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
die("connection failed" . mysqli_error($con));
}

if(isset($_GET['email']) && $_GET['email'] != '')
{
	$email = $_GET['email'];
	$sql = "delete from signlog where email = '".$email."'";
	$result=mysqli_query($con,$sql);
	
	if($result)
	{
		session_destroy();
		echo "1";
	}
	else
	{
		echo "0";
	}
}

?>