<?php  
session_start();
require("connection.php");
$user=$_SESSION['uname'];

$ins="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',3,CURRENT_TIMESTAMP())";
mysqli_query($con,$ins);
unset($_SESSION["uname"]);
session_destroy();
header("Location:login.php");
?>