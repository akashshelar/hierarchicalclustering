<?php
	$con = mysqli_connect("localhost","Lifestandate","TreckN@zional7","TrekSocialDB");
	if(!$con)
	{
		die("Couldn't connect".mysqli_error($con));
	}
	else
	{
		echo "successful";
	}
?>
