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
	
		$sql = "SELECT * FROM signlog WHERE email='$email' AND password='$password' AND delete_flag = 0; ";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result) == 0)
		{
			header('Location:index.php?msg=1');
		}
		else
		{
			$_SESSION['sess_user'] = $_POST['email'];
			header('location:UserPreference.php');
		}
	
	
}
?>