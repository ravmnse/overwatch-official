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
                            <a href="addprod.php" class="pure-menu-link">Add Product</a>
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
                    <h1 class="subhead">Edit/Delete Products</h1>
                    <?php
                    echo"<table class='pure-table pure-table-bordered'>";
                    echo"<thead>";

                    echo"<tr><th>ITEM ID</th><th>ITEM NAME</th><th>PRICE</th><th>STOCK</th><th colspan='2'>ACTION</th></tr>";
                    echo"</thead>";
                    $query="SELECT * FROM ITEM";
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
                            echo"<form action='editprod.php' method='post'>";
                           
                            echo"<tbody>";
                            echo"<input type='hidden' name='item' value='$itid'>";
                            echo "<tr><td>$itid</td><td>$iname</td><td>$iprice</td><td>$istock</td><td colspan='2'><button type='submit' name='edit' class='pure-button button-small button-success'>Edit</button>
                            <button type='submit' name='delete' class='pure-button button-small button-error'>Delete</button></td>";
                            
                            echo"</tbody>";
                            
                            echo"</form>";
                        }
                        echo"</table>";
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
