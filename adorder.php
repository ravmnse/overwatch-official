<?php
session_start();
if(!isset($_SESSION['uname']) or  $_SESSION['role']!=1){
    header("Location:adlogin.php");
die();
}
else{
require("connection.php");
$user=$_SESSION['uname'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Orders - Overwatch</title>

    <link rel="stylesheet" href="assets/css/pure-min.css">
    <link rel="stylesheet" href="assets/css/pure-responsive-min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-3-24">
            <div id="menu">
                <div class="pure-menu">
                    <p class="pure-menu-heading">
                    <?php echo ("Admin: ".$user);?>
                    <br><br>
                        <a href="adlogout.php" class="pure-button button-xsmall">LOG OUT</a>
                    </p>
                    <ul class="pure-menu-list">
                        <li class="pure-menu-item">
                            <a href="dashboard.php" class="pure-menu-link">Dashboard</a>
                        </li>
                        <li class="pure-menu-item pure-menu-selected">
                            <a href="adorders.php" class="pure-menu-link">Orders</a>
                        </li>
                        
                        <li class="pure-menu-item">Products</li>
                        <li class="pure-menu-item">
                            <a href="e_dprod.php" class="pure-menu-link">Edit/Delete Products</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="option-list.html" class="pure-menu-link">Add Product</a>
                        </li>
                        <li class="pure-menu-item">Accounts</li>
                        <li class="pure-menu-item">
                            <a href="e_daccounts.php" class="pure-menu-link">Edit/Delete Accounts</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="addacc.php" class="pure-menu-link">Create New Admin Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content pure-u-1 pure-u-md-21-24">
            <div class="header-small">

                <div class="items">
                    <h1 class="subhead">List of In-Process Orders</h1>
                    <?php

                    $query="SELECT * FROM ORDERS WHERE ORDER_STATUS='In-Process'";
                    $results=mysqli_query($con,$query);
                    $count=mysqli_num_rows($results);
                    if($count>=1){
                        while($res=mysqli_fetch_array($results)){
                            $gt=0;
                            $oid=$res['ORDER_ID'];
                            $odate=$res['ORDER_DATE'];
                            $ostat=$res['ORDER_STATUS'];
                            $ouname=$res['USERNAME'];
                            echo"<form action='adorder.php' method='post'>";
                            echo"<table class='pure-table pure-table-horizontal'>";
                            echo"<thead>";
                            echo"<tr><th colspan='2'>Order Id: $oid</th><th colspan='2'>Order Date: $odate</th><th colspan='2'>Order Status:$ostat</th></tr>";
                            echo"<tr><th>ITEM ID</th><th>ITEM NAME</th><th>PRICE</th><th>QUANTITY</th><th>SUB TOTAL</th><th></th></tr>";
                            echo"</thead>";
                            echo"<tbody>";
                            $query2="SELECT A.ITEM_ID,A.ITEM_NAME,A.PRICE,A.QUANTITY,A.QUANTITY*A.PRICE AS SUBTOTAL FROM (SELECT O.ORDER_ID,O.ITEM_ID,I.ITEM_NAME,I.PRICE,O.QUANTITY FROM ITEM_ORDERS AS O INNER JOIN ITEM AS I ON O.ITEM_ID=I.ITEM_ID WHERE O.ORDER_ID=$oid) AS A";
                            $results2=mysqli_query($con,$query2);
                            while($res2=mysqli_fetch_array($results2)){
                                $c1=$res2['ITEM_ID'];
                                $c2=$res2['ITEM_NAME'];
                                $c3=$res2['QUANTITY'];
                                $c4=$res2['PRICE'];
                                $c5=$res2['SUBTOTAL'];
                                $gt+=$c5;
                                echo "<tr><td>$c1</td><td>$c2</td><td>$c4</td><td>$c3</td><td>$c5</td><td></td>";
                    }
                    echo"<input type='hidden' name='ordid' value='$oid'>";
                    echo "<tr><td colspan='4'></td><td>Grand Total: ₱$gt</td><td><button type='submit' name='com' class='pure-button button-success'>Complete Order</button></td></tr>";
                    echo"</tbody>";
                    echo"</table>";
                    echo"</form>";
                    echo"<br>";

                }
            }
                    else{
                        echo"No active orders!";
                    }
                    ?>
                <?php
                if(isset($_POST['com'])){
                    $x=$_POST['ordid'];
                    $query3="UPDATE ORDERS SET ORDER_STATUS = 'Completed' WHERE ORDER_ID=$x";
                    mysqli_query($con,$query3);
                    $query4="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',9,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query4);
                    header("Location:adorder.php");
                }


?>
                    
                </div>
                
                

                
            </div>
        </div>
    </div>
</body>
</html>
