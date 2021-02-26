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
    <title>Edit Account - Overwatch</title>

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
                        <li class="pure-menu-item ">
                            <a href="e_dprod.php" class="pure-menu-link">Edit/Delete Products</a>
                        </li>
                        <li class="pure-menu-item menu-item-divided">
                            <a href="addprod.php" class="pure-menu-link">Add Product</a>
                        </li>
                        <li class="pure-menu-item">Accounts</li>
                        <li class="pure-menu-item pure-menu-selected">
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
                  
                <h1 class="subhead">Edit Account</h1>
                <?php
                if(isset($_POST['ed'])){
                    $id=$_POST['usid'];

                    $query="SELECT A.USER_ID, A.USER_LNAME,A.USER_FNAME,A.USER_MNAME,A.USER_ADDRESS,A.USER_EMAIL,A.USER_CONTACTNO,B.USERNAME,B.PSWORD FROM USERS AS A INNER JOIN ACCOUNTS AS B ON A.USER_ID=B.USER_ID WHERE A.USER_ID=$id";
                    $results=mysqli_query($con,$query);
                    $count=mysqli_num_rows($results);
                    if($count>=1){
                        while($res=mysqli_fetch_array($results)){
                            
                            $userid=$res['USER_ID'];
                            $lname=$res['USER_LNAME'];
                            $fname=$res['USER_FNAME'];
                            $mname=$res['USER_MNAME'];
                            $address=$res['USER_ADDRESS'];
                            $email=$res['USER_EMAIL'];
                            $contact=$res['USER_CONTACTNO'];
                            $username=$res['USERNAME'];
                            $pass=$res['PSWORD'];

                    echo"<form action='editacc.php' method='post' novalidate autocomplete='off' class='pure-form pure-form-stacked'>";
                    echo"<fieldset>";
                    echo"<input type='hidden' name='pid' value=$id>";
                    echo"<input type='hidden' name='oldus' value='$username'>";
                    echo"<label for='1'>LAST NAME</label>";
                    echo"<input id='1' type='text' class='pure-input-1' name='a1' value='$lname' required>";
                    echo"<br>";
                    echo"<label for='2'>FIRST NAME</label>";
                    echo"<input id='2' type='text' class='pure-input-1' name='a2'value='$fname' required>";
                    echo"<br>";
                    echo"<label for='3'>MNAME</label>";
                    echo"<input id='3' type='text' class='pure-input-1' name='a3'value='$mname' >";
                    echo"<br>";
                    echo"<label for='4'>ADDRESS</label>";
                    echo"<input id='4' type='text' class='pure-input-1' name='a4' value='$address' required>";
                    echo"<br>";
                    echo"<label for='5'>EMAIL</label>";
                    echo"<input id='5' type='text' class='pure-input-1'name='a5' value='$email' required>";
                    echo"<br>"; 
                    echo"<label for='6'>CONTACT NO.</label>";
                    echo"<input id='6' type='text' class='pure-input-1' name='a6' value='$contact' required>";
                    echo"<br>";
                    echo"<label for='7'>USERNAME</label>";
                    echo"<input id='7' type='text' class='pure-input-1'name='a7' value='$username' required>";
                    echo"<br>"; 
                    echo"<label for='8'>PASSWORD</label>";
                    echo"<input id='8' type='password' class='pure-input-1'name='a8' value='$pass' required>";
                    echo"<br>";      
                    echo"<button type='submit' class='pure-button button-success' name='save'>Save</button>";
                    echo"</fieldset>";
                echo"</form>";
                }
            }}
                ?>
            <?php
            if(isset($_POST['save'])){
                        $b=$_POST['pid'];
                        $b0=$_POST['oldus'];
                        $b1=$_POST['a1'];
                        $b2=$_POST['a2'];
                        $b3=$_POST['a3'];
                        $b4=$_POST['a4'];
                        $b5=$_POST['a5'];
                        $b6=$_POST['a6'];
                        $b7=$_POST['a7'];
                        $b8=$_POST['a8'];

                        $query2="Select * FROM ACCOUNTS WHERE username='$b7'";
                        $result2=mysqli_query($con,$query2);
                        $row2=mysqli_fetch_array($result2);
                        $count2= mysqli_num_rows($result2);
                        if($b0==$b7){
                            $query3="UPDATE USERS SET `USER_LNAME`='$b1',`USER_FNAME`='$b2',`USER_MNAME`='$b3',`USER_ADDRESS`='$b4',`USER_EMAIL`='$b5',`USER_CONTACTNO`='$b6' WHERE USER_ID=$b";
                            mysqli_query($con,$query3);
                            $query4="UPDATE ACCOUNTS SET `PSWORD`='$b8' WHERE `USERNAME`='$b0'";
                            mysqli_query($con,$query4);
                            $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',7,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query5);
                    
                            echo "<script>alert('Edit Account Success!');window.location.href='e_daccounts.php';  </script>";
                            
                        }
                        if($b0!=$b7){
                        if($count2== 1) {

                            echo "<script>alert('Username Already Taken');window.location.href='e_daccounts.php';  </script>";
                            //echo "<script> alert('Username Already Taken')</script>";
                          //  header("Location:signup.php");
                        //if(isset($_SESSION['uname'])){
                        //echo "<h1> Welcome ".$_SESSION['uname']."<h1>";
    
                        }
                        else{
                            $query3="UPDATE USERS SET `USER_LNAME`='$b1',`USER_FNAME`='$b2',`USER_MNAME`='$b3',`USER_ADDRESS`='$b4',`USER_EMAIL`='$b5',`USER_CONTACTNO`='$b6' WHERE USER_ID=$b";
                            mysqli_query($con,$query3);
                            $query4="UPDATE ACCOUNTS SET `USERNAME`='$b7',`PSWORD`='$b8' WHERE `USERNAME`='$b0'";
                            mysqli_query($con,$query4);
                            $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',7,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query5);
                            $_SESSION['uname']=$b7;
                            echo "<script>alert('Edit Account Success!');window.location.href='e_daccounts.php';  </script>";
                   
                        }
                    }

            }

            ?>

            <?php
            if(isset($_POST['del'])){
                $id2=$_POST['usid'];
                $q="DELETE FROM USERS WHERE USER_ID=$id2";
                mysqli_query($con,$q);
                $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',13,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query5);
                header("Location:e_daccounts.php");
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
