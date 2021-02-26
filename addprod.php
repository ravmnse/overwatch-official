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
    <title>Add Products - Overwatch</title>

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
                    <?php  echo("Admin: ".$user);?>
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
                        <li class="pure-menu-item">
                            <a href="e_dprod.php" class="pure-menu-link">Edit/Delete Products</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="option-list.html" class="pure-menu-link pure-menu-selected" >Add Product</a>
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
                  
                <h1 class="subhead">Add Product</h1>
                <form action='addprod.php' method='post' novalidate autocomplete='off' class='pure-form pure-form-stacked'>
                    <fieldset>
                    
                    <label for='1'>ITEM ID</label>
                    <input id='1' type='number' class='pure-input-1' name='item_id' placeholder="Enter Item Id" required>
                    <br>
                    <label for='2'>ITEM NAME</label>
                    <input id='2' type='text' class='pure-input-1' name='item_name'placeholder="Enter Item Name" required>
                    <br>
                    <label for='3'>DESCRIPTION</label>
                    <input id='3' type='text' class='pure-input-1' name='item_desc'placeholder="Enter Item Description" required>
                    <br>
                    <label for='4'>IMAGE FILE NAME AND FORMAT</label>
                    <input id='4' type='text' class='pure-input-1' name='item_img' placeholder="Enter Item Image File Name and Format" required>
                    <br>
                    <label for='5'>PRICE</label>
                    <input id='5' type='number' class='pure-input-1' name='item_price' placeholder="Enter Item Price" required>
                    <br>
                    <label for='6'>STOCK</label>
                    <input id='6' type='number' class='pure-input-1'name='item_stock' placeholder="Enter Item Stock" required>
                    <br>
                    <button type='submit' class='pure-button button-success' name='addproduct'>Add Product</button>
                    </fieldset>
                </form>  

            <?php
            if(isset($_POST['addproduct'])){
             
                $x1=$_POST['item_id'];
                $x2=$_POST['item_name'];
                $x3=$_POST['item_desc'];
                $x4=$_POST['item_img'];
                $x5=$_POST['item_price'];
                $x6=$_POST['item_stock'];

                $query="INSERT INTO ITEM(`ITEM_ID`,`ITEM_NAME`,`ITEM_DESC`,`ITEM_IMG_NAME`,`PRICE`,`STOCK`) VALUES($x1,'$x2','$x3','$x4',$x5,$x6)";
                mysqli_query($con,$query);
                $query4="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',10,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query4);
                            echo "<script>alert('Successsfully Added New Product!');</script>";
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
