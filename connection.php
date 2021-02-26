<?php

$hostname = "localhost:3307";
$user = "root";
$pwd = "";
$dbname = "overwatch";
$con = mysqli_connect($hostname,$user,$pwd,$dbname);

if($con)
{
	
}
else
{
	echo mysqli_connect_error();
}


?>