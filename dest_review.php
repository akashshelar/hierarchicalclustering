<?php

$con=mysqli_connect('localhost','root',''); 

mysqli_select_db($con,'beproj');

if(!$con)

{

die("connection failed" . mysqli_error($con));

}

else

{

$dest_name=mysqli_real_escape_string($con,$_POST['dest_name']);

$rating=mysqli_real_escape_string($con,$_POST['rating']);

$review=mysqli_real_escape_string($con,$_POST['review']);

$sql = "INSERT INTO review(dest_name,rating,review) VALUES ('$dest_name','$rating','$review')";

if(!mysqli_query($con,$sql))

{

die('error:'.mysqli_error($con));

}

echo '<script type="text/javascript">alert("Rating and review recorded successfully");</script>';

}

echo '<a href="UserPreference.php">Click here to continue to the site</a>';

mysqli_close($con);

?>

