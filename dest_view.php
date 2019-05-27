<html>

<body>



<?php

$connection = mysqli_connect('localhost','root','','beproj') or die("failed");

$rs=mysqli_query($connection,"SELECT * FROM review");

echo "<table border='1'>";

echo "<tr>";

echo "<td><big>Destination Name</big></td>";

echo "<td><big>Rating</big></td>";

echo "<td><big>Review</big></td>";

echo "</tr>";

while($row = mysqli_fetch_array($rs)){

echo "<tr>";

echo "<td>".$row['dest_name']."</td>";

echo "<td>".$row['rating']."</td>";

echo "<td>".$row['review']."</td>";

echo "</tr>";

}

echo "</table>"

?>



<a href="user_page.php"> click here to go back </a>

</body>

</html>