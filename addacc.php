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
    <title>Create New Admin Account - Overwatch</title>

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
                            <a href="addprod.php" class="pure-menu-link" >Add Product</a>
                        </li>
                        <li class="pure-menu-item">Accounts</li>
                        <li class="pure-menu-item">
                            <a href="e_daccounts.php" class="pure-menu-link">Edit/Delete Accounts</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="addacc.php" class="pure-menu-link pure-menu-selected">Create New Admin Account</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content pure-u-1 pure-u-md-21-24">
            <div class="header-small">

                <div class="items">
                  
                <h1 class="subhead">Create New Admin Account</h1>
                <form action='addacc.php' method='post' novalidate autocomplete='off' class='pure-form pure-form-stacked'>
                    <fieldset>
                        <label for="FNAME"><b>First Name</b></label>
                        <input type="text" class='pure-input-1' placeholder="Enter Your First Name" name="FNAME" value="<?php echo $_POST['FNAME'] ?? ''; ?>" required>
                        <br>
                        <label for="MNAME"><b>Middle Name</b></label>
                        <input type="text" class='pure-input-1' placeholder="Enter Your Middle Name" name="MNAME" value="<?php echo $_POST['MNAME'] ?? ''; ?>">
                        <br>
                        <label for="LNAME"><b>Last Name</b></label>
                        <input type="text" class='pure-input-1' placeholder="Enter Your Last Name" name="LNAME" value="<?php echo $_POST['LNAME'] ?? ''; ?>" required>
                        <br>
                        <label for="ADDRESS"><b>Home Address</b></label>
                        <input type="text" class='pure-input-1'placeholder="House #, Street, City, Zip code" name="ADDRESS" value="<?php echo $_POST['ADDRESS'] ?? ''; ?>" required>
                        <br>
                        <label for="EMAIL"><b>Email Address</b></label>
                        <input type="text" class='pure-input-1'placeholder="Enter Valid Email Address" name="EMAIL" value="<?php echo $_POST['EMAIL'] ?? ''; ?>" required>
                        <br>
                        <label for="MOBILE"><b>Mobile Number</b></label>
                        <input type="text" class='pure-input-1'placeholder="Enter Your Mobile Number" name="MOBILE" value="<?php echo $_POST['MOBILE'] ?? ''; ?>" required>
                        <br>
                        <label for="uname"><b>Username</b></label>
                        <input type="text" class='pure-input-1'placeholder="Enter Username" name="uname" value="<?php echo $_POST['uname'] ?? ''; ?>" required>
                        <br>
                        <label for="psw"><b>Password</b></label>
                        <input type="password" class='pure-input-1'placeholder="Enter Password" name="psw" value="<?php echo $_POST['psw'] ?? ''; ?>" required>
                        <br>
                        <button type="submit" class='pure-button button-success' name="addn">Create account</button>
                    
                    </fieldset>
                </form>  

            <?php
            if(isset($_POST['addn'])){
             
                $fname=$_POST['FNAME'];
                $mname=$_POST['MNAME'];
                $lname=$_POST['LNAME'];
                $address=$_POST['ADDRESS'];
                $email=$_POST['EMAIL'];
                $mobile=$_POST['MOBILE'];
                $uname=$_POST['uname'];
                $psw=$_POST['psw'];
               
                $query="Select * FROM ACCOUNTS WHERE username='$uname'";
               
                $ins2="INSERT INTO `USERS` (`USER_LNAME`,`USER_FNAME`,`USER_MNAME`,`USER_ADDRESS`,`USER_EMAIL`,`USER_CONTACTNO`) VALUES('$lname','$fname','$mname','$address','$email','$mobile')";
                $result=mysqli_query($con,$query);
                $row=mysqli_fetch_array($result);
                $count = mysqli_num_rows($result);
                if($count == 1) {
                    echo "<script> alert('Username Already Taken')</script>";
                  //  header("Location:signup.php");
                //if(isset($_SESSION['uname'])){
                //echo "<h1> Welcome ".$_SESSION['uname']."<h1>";

                }
                else{
                    mysqli_query($con,$ins2);
                    $last_id = mysqli_insert_id($con);
                    $ins="INSERT INTO `ACCOUNTS` (`USER_ID`,`ROLE_ID`,`USERNAME`,`PSWORD`) values ($last_id,1,'$uname','$psw')";
                    mysqli_query($con,$ins);
                    $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',8,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query5);
                    
                    echo "<script> alert('Account Created!')</script>";
                    echo "<script>location.href='addacc.php'</script>";
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
