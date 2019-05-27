<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
	die("connection failed" . mysqli_error($con));
}
else
{
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	
	$sql = "SELECT * FROM signlog WHERE email='$email' AND password='$password' AND is_admin = '1';";
	$result=mysqli_query($con,$sql);
	
	if(mysqli_num_rows($result) == 0)
	{
		header('location:index.php?msg=2');
	}
	else
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['sess_admin'] = $row['email'];
		header('location:AddDestination.php');
	}
}
?>