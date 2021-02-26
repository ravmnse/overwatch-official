<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Admin Log In - Overwatch</title>

    <link rel="stylesheet" href="assets/css/pure-min.css">
    <link rel="stylesheet" href="assets/css/pure-responsive-min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="main" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-2">
            <div class="header-large">
                <h1>OVERWATCH: Smart Security </h1>
                <h2>Admin Page</h2>
                <br><br>
                <img src="images/pic01.jpg" width="600px" height="400px">
                <?php
                require("connection.php");
                session_start();
                if(isset($_POST['sign'])){
                   
                    $uname=$_POST['un'];
                    $psw=$_POST['pw'];
                    
                    $query="Select * FROM accounts WHERE username='$uname' AND psword='$psw' AND ROLE_ID=1";
                    $result=mysqli_query($con,$query);
                    $row=mysqli_fetch_array($result);
                    $count = mysqli_num_rows($result);

                    if($count == 1) {
                        if($row['USERNAME']!=$uname)
                        {
                            echo "<script> alert('invalid login')</script>";
                            echo "<script>location.href='adlogin.php'</script>";
                        }
                        else{
                            $_SESSION['uname']=$row['USERNAME'];
                            $_SESSION['uid']=$row['USER_ID'];
                            $_SESSION['role']=$row['ROLE_ID'];
                            $ins="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$uname',2,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$ins);
                            header("Location:dashboard.php");
                        }
                      
                    }
                    else{
                        echo "<script> alert('invalid login')</script>";
                        echo "<script>location.href='adlogin.php'</script>";
                    }
                        
                    }

                    
                     
                     ?>
                <nav class="nav">
                    <ul>
                        <li>
                           
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="content pure-u-1 pure-u-md-1-2">
            <div class="header-medium">

                <div class="items">
                    <br><br><br><br><br>
                    <h1 class="subhead">Login</h1>

                    
                    <form action="adlogin.php" method="post" class="pure-form pure-form-stacked">
                        <fieldset>
                            <label for="username">Username</label>
                            <input id="username" type="text" placeholder="Enter Username" name='un' class="pure-input-1" value="">
                            <br>
                            <label for="password">Password</label>
                            <input id="password" type="password" placeholder="Enter Password" name='pw' class="pure-input-1" value="">
                            <br>
                            <button type="submit" name='sign'class="pure-button button-success">Sign in</button>
                        </fieldset>
                    </form>
                </div>
                
                


                
                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
