<?php
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
die("connection failed" . mysqli_error($con));
}
else
{
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$age=mysqli_real_escape_string($con,$_POST['age']);
	$gender=mysqli_real_escape_string($con,$_POST['gender']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$phone=mysqli_real_escape_string($con,$_POST['phone']);
	if(strlen($password) >= 8 )
	{
	$sql = "SELECT * FROM signlog WHERE email='$email' and delete_flag = 0";
	
	$result=mysqli_query($con,$sql);
	
		if(mysqli_num_rows($result) == 0)
		{
		
			$sql = "INSERT INTO signlog(name,age,gender,email,password,phone)VALUES ('$name','$age','$gender','$email','$password','$phone')";
			
			if(!mysqli_query($con,$sql))
			{
				die('error:'.mysqli_error($con));
			}
			header('location:index.php?msg=5');
		}
		else
		{
			header('location:index.php?msg=6');
		}
	}
	else
	{
		header('location:index.php?msg=8');
	}
}
mysqli_close($con);
?>