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
    <title>Dashboard - Overwatch</title>

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
                        <li class="pure-menu-selected">
                            <a href="dashboard.php" class="pure-menu-link">Dashboard</a>
                        </li>
                        <li>
                            <a href="adorder.php" class="pure-menu-link">Orders</a>
                        </li>
                        <li class="pure-menu-item">Products</li>
                        <li>
                            <a href="e_dprod.php" class="pure-menu-link">Edit/Delete Products</a>
                        </li>
                        <li class="menu-item-divided">
                            <a href="addprod.php" class="pure-menu-link">Add Product</a>
                        </li>
                        <li class="pure-menu-item">Accounts</li>
                        <li>
                            <a href="e_daccounts.php" class="pure-menu-link">Edit/Delete Accounts</a>
                        </li>
                        <li class="menu-item-divided">
                            <a href="addacc.php" class="pure-menu-link">Create New Admin Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content pure-u-1 pure-u-md-21-24">
            <div class="header-small">

                <div class="items">
                    <h1 class="subhead">Dashboard</h1>
                </div>

                <div class="pure-g">

                    <div class="pure-u-1 pure-u-md-1-3">
                        <div class="column-block">
                            <div class="column-block-header column-success">
                    <?php
                    $query="Select * FROM accounts WHERE ROLE_ID=2";
                    $result=mysqli_query($con,$query);
                    $row=mysqli_fetch_array($result);
                    $count = mysqli_num_rows($result);
                                echo"<h2>Customer Accounts</h2>";
                                echo"<span class='column-block-info'> $count <span>Total</span> </span>";

                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <div class="column-block">
                            <div class="column-block-header column-warning">

                            <?php
                            $query2="select * from ORDERS
                            where MONTH(ORDER_DATE)=MONTH(now())
                            and YEAR(ORDER_DATE)=YEAR(now())";
                            $result2=mysqli_query($con,$query2);
                            $row2=mysqli_fetch_array($result2);
                            $count2= mysqli_num_rows($result2);

                                echo"<h2>Orders</h2>";
                                echo"<span class='column-block-info'>$count2 <span>this month</span></span>";
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="pure-u-1 pure-u-md-1-3">
                        <div class="column-block">
                            <div class="column-block-header">
                                <?php
                                $query3="select * from ACCOUNT_AUDIT
                                where MONTH(AUD_DATE)=MONTH(now())
                                and YEAR(AUD_DATE)=YEAR(now())";
                                $result3=mysqli_query($con,$query3);
                                $row3=mysqli_fetch_array($result3);
                                $count3= mysqli_num_rows($result3);
                                echo"<h2>User Activities</h2>";
                                echo"<span class='column-block-info'>$count3 <span>this month</span></span>";
                                ?>
                            </div>
                    
                        </div>
                    </div>

                </div>
                <div class="items">
                    <h1 class="subhead">Audit Trail (User Activities)</h1>
                </div>
                <form action="dashboard.php" method="post">
                        
                        <input id="username" type="text" placeholder="Enter Username" name='uname' class="pure-input-1" value="" size=25 style>
                            <button type="submit" name='search'class="pure-button button-success">Search</button>
                        </fieldset>
                    </form>
                    <div class="items">

                    <?php
                    echo"<table class='pure-table pure-table-bordered'>";
                      echo"<thead>";
              
                      echo"<tr>";
                      echo"<th>Username</th>";
                      echo"<th>Action ID</th>";
                      echo"<th>Action</th>";
                      echo"<th>Action Date</th>";
                      echo"</tr>";
                      echo"</thead>";
                    if(isset($_POST['search'])){
                        $n=$_POST['uname'];
                         $query4="SELECT A.USERNAME,A.ACTION_ID,B.ACTION_NAME,A.AUD_DATE AS `ACTION_DATE`FROM account_audit AS A INNER JOIN audit_trail AS B ON A.ACTION_ID=B.ACTION_ID WHERE A.USERNAME='$n' ORDER BY A.AUD_DATE";
                         $result4=mysqli_query($con,$query4);
                         $count4= mysqli_num_rows($result4);
                         if($count4>=1){
                            while($row4=mysqli_fetch_array($result4)){
                                $name=$row4['USERNAME'];
                                $aid=$row4['ACTION_ID'];
                                $aname=$row4['ACTION_NAME'];
                                $adate=$row4['ACTION_DATE'];
                        echo"<tbody>";
                        echo"<tr>";
                        echo"<td>$name</td>";
                        echo"<td>$aid</td>";
                        echo"<td>$aname</td>";
                        echo"<td>$adate</td>";
                        echo"</tr>";
                        echo"</tbody>";
                            }
                        }
                        else{
                        echo"<tbody>";
                        echo"<tr>";
                        echo"<td colspan='4'> Username does not exist!</td>";
                        echo"</tr>";
                        echo"</tbody>";
                        }

            
        }
        echo"</table>";
            
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
