<?php
$con=mysqli_connect('localhost','root',''); 
mysqli_select_db($con,'beproj');
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
$sql = "INSERT INTO user_info(name,age,gender,email,password,phone)VALUES ('$name','$age','$gender','$email','$password','$phone')";

if(!mysqli_query($con,$sql))
{
die('error:'.mysqli_error($con));
}
header('location:index.html');
}
mysqli_close($con);
?>