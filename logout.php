<?php

session_start();
unset($_SESSION['see_admin']);
session_destroy();
header("location:index.php");

?>