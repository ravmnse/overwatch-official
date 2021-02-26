<?php
require("connection.php");
session_start();
$uname=$_POST['uname'];
$psw=$_POST['psw'];

$query="Select * FROM accounts WHERE username='$uname' AND psword='$psw'";

$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
if($count == 1) {
    if($row['USERNAME']!=$uname)
    {
        echo "<script> alert('invalid login')</script>";
        echo "<script>location.href='login.php'</script>";
    }
    else{
        $_SESSION['uname']=$row['USERNAME'];
        $_SESSION['uid']=$row['USER_ID'];
       
        $ins="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$uname',2,CURRENT_TIMESTAMP())";
    mysqli_query($con,$ins);
        
        
        header("Location:index2.php");
    }
   
}


else{
   // session_destroy();
    echo "<script> alert('invalid login')</script>";
    echo "<script>location.href='login.php'</script>";
}

?>