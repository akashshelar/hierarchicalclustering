<?php
session_start();
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
die("connection failed" . mysqli_error($con));
}
$email=mysqli_real_escape_string($con,$_POST['email']);

$sql = "SELECT * FROM signlog WHERE email='$email' ";

$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result) == 0)
{
	header('Location:index.php?msg=2');
}
else
{
	$to = $email;
	$subject = "Trek social Forgot password";
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: <info@treksocial.in>' . "\r\n";
	if($email != '')
	{
		$sql = "select password,name from signlog where email='".$email."'";
		$result = $con->query($sql);
		while($row = $result->fetch_assoc()) {
			$password = $row['password'];
			$name = $row['name'];
		}
		$message = "<p>Hello, $name please check your password </p>
					<table>
						<tr>
							<th>Email</th>
							<th>Password</th>
						</tr>
						<tr>
							<td>".$email."</td>
							<td>".$password."</td>
						</tr>
					</table>
					";
		$send_mail = mail($to,$subject,$message,$headers);
		if($send_mail)
		{
			header('Location:index.php?msg=3');
		}
		else
		{
			header('Location:index.php?msg=4');
		}
	}
}