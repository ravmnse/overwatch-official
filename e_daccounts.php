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
    <title>Edit/Delete Accounts - Overwatch</title>

    <link rel="stylesheet" href="assets/css/pure-min.css">
    <link rel="stylesheet" href="assets/css/pure-responsive-min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    input[type=text] {
  width: 35%;
  padding: 10px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}
    </style>
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
                        <li class="pure-menu-item">
                            <a href="e_dprod.php" class="pure-menu-link">Edit/Delete Products</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="addprod.php" class="pure-menu-link">Add Product</a>
                        </li>
                        <li class="pure-menu-item">Accounts</li>
                        <li class="pure-menu-item  pure-menu-selected">
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
                    <h1 class="subhead">Edit/Delete Accounts</h1>
                    <form action="e_daccounts.php" method="post">
          
                        <input id="username" type="text" placeholder="Enter Username" name='uname' class="pure-input-1" value="" size=25 style>
                            <button type="submit" name='search'class="pure-button button-success">Search</button>
                        
                        </form>
                   
                    <?php
                        if(isset($_POST['search'])){
                            $x=$_POST['uname'];
                            echo"<table class='pure-table pure-table-bordered'>";
                            echo"<thead>";
        
                            echo"<tr><th>USER ID</th><th>USERNAME</th><th>ROLE</th><th colspan='2'>ACTION</th></tr>";
                            echo"</thead>";
                            $query="SELECT A.USER_ID, A.USERNAME, B.ROLE_NAME FROM ACCOUNTS AS A INNER JOIN ROLES AS B ON A.ROLE_ID=B.ROLE_ID WHERE A.USERNAME='$x'";
                            $results=mysqli_query($con,$query);
                            $count=mysqli_num_rows($results);
                            if($count>=1){
                                while($res=mysqli_fetch_array($results)){
                                    
                                    $uid=$res['USER_ID'];
                                    $un=$res['USERNAME'];
                                    $role=$res['ROLE_NAME'];
                                    
                                    echo"<form action='editacc.php' method='post'>";
                                   
                                    echo"<tbody>";
                                    echo"<input type='hidden' name='usid' value='$uid'>";
                                    echo "<tr><td>$uid</td><td>$un</td><td>$role</td><td colspan='2'><button type='submit' name='ed' class='pure-button button-small button-success'>Edit</button>
                                    <button type='submit' name='del' class='pure-button button-small button-error'>Delete</button></td>";
                                    
                                    echo"</tbody>";
                                    
                                    echo"</form>";
                                }
                                echo"</table>";
                            }

                        }
                        else{
                            echo"<table class='pure-table pure-table-bordered'>";
                            echo"<thead>";
        
                            echo"<tr><th>USER ID</th><th>USERNAME</th><th>ROLE</th><th colspan='2'>ACTION</th></tr>";
                            echo"</thead>";
                            $query="SELECT A.USER_ID, A.USERNAME, B.ROLE_NAME FROM ACCOUNTS AS A INNER JOIN ROLES AS B ON A.ROLE_ID=B.ROLE_ID ORDER BY A.USER_ID ASC";
                            $results=mysqli_query($con,$query);
                            $count=mysqli_num_rows($results);
                            if($count>=1){
                                while($res=mysqli_fetch_array($results)){
                                    
                                    $uid=$res['USER_ID'];
                                    $un=$res['USERNAME'];
                                    $role=$res['ROLE_NAME'];
                                    
                                    echo"<form action='editacc.php' method='post'>";
                                   
                                    echo"<tbody>";
                                    echo"<input type='hidden' name='usid' value='$uid'>";
                                    echo "<tr><td>$uid</td><td>$un</td><td>$role</td><td colspan='2'><button type='submit' name='ed' class='pure-button button-small button-success'>Edit</button>
                                    <button type='submit' name='del' class='pure-button button-small button-error'>Delete</button></td>";
                                    
                                    echo"</tbody>";
                                    
                                    echo"</form>";
                                }
                                echo"</table>";
                            }


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
