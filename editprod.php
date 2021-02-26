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
    <title>Edit/Delete Products - Overwatch</title>

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
                        <li class="pure-menu-item">
                            <a href="adorder.php" class="pure-menu-link">Orders</a>
                        </li>
                        
                        <li class="pure-menu-item">Products</li>
                        <li class="pure-menu-item pure-menu-selected">
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
                  
                <h1 class="subhead">Edit Product</h1>
                <?php
                if(isset($_POST['edit'])){
                    $id=$_POST['item'];

                    $query="SELECT * FROM ITEM WHERE ITEM_ID=$id";
                    $results=mysqli_query($con,$query);
                    $count=mysqli_num_rows($results);
                    if($count>=1){
                        while($res=mysqli_fetch_array($results)){
                            
                            $itid=$res['ITEM_ID'];
                            $iname=$res['ITEM_NAME'];
                            $idesc=$res['ITEM_DESC'];
                            $img=$res['ITEM_IMG_NAME'];
                            $iprice=$res['PRICE'];
                            $istock=$res['STOCK'];
                    echo"<form action='editprod.php' method='post' novalidate autocomplete='off' class='pure-form pure-form-stacked'>";
                    echo"<fieldset>";
                    echo"<input type='hidden' name='pid' value=$id>";
                    echo"<label for='1'>ITEM ID</label>";
                    echo"<input id='1' type='number' class='pure-input-1' name='item_id' value=$itid required>";
                    echo"<br>";
                    echo"<label for='2'>ITEM NAME</label>";
                    echo"<input id='2' type='text' class='pure-input-1' name='item_name'value='$iname' required>";
                    echo"<br>";
                    echo"<label for='3'>DESCRIPTION</label>";
                    echo"<input id='3' type='text' class='pure-input-1' name='item_desc'value='$idesc' required>";
                    echo"<br>";
                    echo"<label for='4'>IMAGE FILE NAME AND FORMAT</label>";
                    echo"<input id='4' type='text' class='pure-input-1' name='item_img' value='$img' required>";
                    echo"<br>";
                    echo"<label for='5'>PRICE</label>";
                    echo"<input id='5' type='number' class='pure-input-1' name='item_price' value=$iprice required>";
                    echo"<br>";
                    echo"<label for='6'>STOCK</label>";
                    echo"<input id='6' type='number' class='pure-input-1'name='item_stock' value=$istock required>";
                    echo"<br>";     
                    echo"<button type='submit' class='pure-button button-success' name='save'>Save</button>";
                    echo"</fieldset>";
                echo"</form>";
                }
            }}

                ?>
            <?php
            if(isset($_POST['delete'])){
                $id2=$_POST['item'];
                $q="DELETE FROM ITEM WHERE ITEM_ID=$id2";
                mysqli_query($con,$q);
                $query4="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',12,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query4);
                header("Location:e_dprod.php");
            }

            ?>

            <?php
            if(isset($_POST['save'])){
                $pid=$_POST['pid'];
                $x1=$_POST['item_id'];
                $x2=$_POST['item_name'];
                $x3=$_POST['item_desc'];
                $x4=$_POST['item_img'];
                $x5=$_POST['item_price'];
                $x6=$_POST['item_stock'];

                $query2="UPDATE ITEM SET ITEM_ID=$x1, ITEM_NAME='$x2', ITEM_DESC='$x3', ITEM_IMG_NAME='$x4', PRICE=$x5, STOCK=$x6 WHERE ITEM_ID=$pid";
                mysqli_query($con,$query2);
                $query4="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',11,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query4);
                echo "<script>alert('Edit Product Success!');window.location.href='e_dprod.php';  </script>";
               
            }


?>

                </div>

                

                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                        <li class="pure-menu-item"><a href="#" class="pure-menu-link">OVERWATCH: SMART SECURITY 2021</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
