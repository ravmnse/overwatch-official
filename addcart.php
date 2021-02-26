
<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("Location:login.php");
die();
}
else{
require("connection.php");
$user=$_SESSION['uname'];

    if(isset($_POST['add'])){
        $QUAN=$_POST['qty'];
        $PID=$_POST['pid'];
        

    if($QUAN>0 && filter_var($QUAN, FILTER_VALIDATE_INT)){
        $exist="Select * FROM cart WHERE username='$user' AND ITEM_ID=$PID";
       
        $res=mysqli_query($con,$exist);
        $row=mysqli_fetch_array($res);
        $count = mysqli_num_rows($res);
        if($count == 1) {
            $q=$row['QUANTITY'];
            $nq=$q+$QUAN;
            $upd="UPDATE `CART` SET `QUANTITY`=$nq WHERE username='$user' AND ITEM_ID=$PID";
            mysqli_query($con,$upd);
            header("Location:cart.php");

         }
         else{
            $acart="INSERT INTO `CART` (`USERNAME`,`ITEM_ID`,`QUANTITY`) VALUES('$user',$PID,$QUAN)";
            mysqli_query($con,$acart);
            header("Location:cart.php");


         }

    }

   
    /*
    require("connection.php");
    $item=$_GET['id'];
    $qty=$_GET['qty1'];
    $un=$_SESSION['uname'];
    $query="Select * FROM cart WHERE username='$un' AND ITEM_ID=$item";

echo($qty);
    /*$result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if($count == 1) {
    echo ("may laman");
    }
    else{
        $ins=
}*/
}

}

?>

