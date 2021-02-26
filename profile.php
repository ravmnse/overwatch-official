<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("Location:login.php");
die();
}
else{
require("connection.php");
   $user=$_SESSION['uname'];
  
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Profile - Overwatch</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
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
                            $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$b0',7,CURRENT_TIMESTAMP())";
                            mysqli_query($con,$query5);
                    
                            echo "<script>alert('Edit Account Success!');window.location.href='profile.php';  </script>";
                            
                        }
                        if($b0!=$b7){
                            if($count2== 1) {

                                echo "<script>alert('Username Already Taken');window.location.href='profile.php';  </script>";
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
                                $query5="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$b7',7,CURRENT_TIMESTAMP())";
                                mysqli_query($con,$query5);
                                $_SESSION['uname']=$b7;
                                echo "<script>alert('Edit Account Success!');window.location.href='profile.php';  </script>";
                       
                            }

                        }
                        

            }

            ?>
	</head>
	<body class="no-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">

					<!-- Logo -->
						<h1><a href="index.html">OVERWATCH</a></h1>

					<!-- Nav -->
						<nav id="nav">
                        <ul>
							<li> Welcome <?php echo $user;?>!</li>
							</ul>
							<ul>
                            
								<li><a href="index2.php">Home</a></li>
                               
								<li>
									<a href="products.php">Products</a>
									<ul>
										<li><a href="products.php">Motion Detectors</a></li>
										<li><a href="products.php">Biometrics</a></li>
										<li><a href="products.php">RFID Locks</a></li>
										<li>
											<a href="products.php">Smart Home Security</a>
											<ul>
												<li><a href="products.php">CCTV Cameras</a></li>
												<li><a href="products.php">AI Identification</a></li>
												<li><a href="products.php">Smart Surveillance</a></li>
												<li><a href="products.php">Security Servers</a></li>
												<li><a href="products.php">Encryption Keys</a></li>
											</ul>
								  	</ul>
							  </li>
								<li><a href="about.php">About Us</a></li>
								<li class="current"><a href=#>Account</a>
                                <ul>
									<li><a href="profile.php">Profile</a></li>
									<li><a href="orders.php">Orders</a></li>
                                    <li><a href="logout.php">Logout</a></li>

                                </ul>  
                            </li>
                            <li> <a href="cart.php"> <img src="images/cart.png" width="25px" height="25px"></a></li>
							</ul>
						</nav>
						
                </section>
            <!-- Main -->
			<section id="main">
				<div class="container">
					<div class="row">
						<div class="col-12">

            <!-- Account -->
            <section>
                <header class="major">
                    <h2>Profile</h2>
                </header>
               
                    <div class="container">
                    <?php
                     $id=$_SESSION['uid'];

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

                    echo"<form action='profile.php' method='post'>";
    
                    echo"<input type='hidden' name='pid' value=$id>";
                    echo"<input type='hidden' name='oldus' value='$user'>";
                    echo"<label for='1'>LAST NAME</label>";
                    echo"<input id='1' type='text'  name='a1' value='$lname' required>";
                    echo"<br>";
                    echo"<label for='2'>FIRST NAME</label>";
                    echo"<input id='2' type='text'  name='a2'value='$fname' required>";
                    echo"<br>";
                    echo"<label for='3'>MNAME</label>";
                    echo"<input id='3' type='text'  name='a3'value='$mname' >";
                    echo"<br>";
                    echo"<label for='4'>ADDRESS</label>";
                    echo"<input id='4' type='text'  name='a4' value='$address' required>";
                    echo"<br>";
                    echo"<label for='5'>EMAIL</label>";
                    echo"<input id='5' type='text' name='a5' value='$email' required>";
                    echo"<br>"; 
                    echo"<label for='6'>CONTACT NO.</label>";
                    echo"<input id='6' type='text'  name='a6' value='$contact' required>";
                    echo"<br>";
                    echo"<label for='7'>USERNAME</label>";
                    echo"<input id='7' type='text' name='a7' value='$username' required>";
                    echo"<br>"; 
                    echo"<label for='8'>PASSWORD</label>";
                    echo"<input id='8' type='password' name='a8' value='$pass' required>";
                    echo"<br>";      
                    echo"<button type='submit' name='save'>Save changes</button>";
                    
                echo"</form>";
                }
            }
                ?>
                    </div>
                   
                    <br>
                   
                  </form>
            </section>
                        </div>
                    </div>
                </div> 
            </section>           
                
         
            
    </div>
</section>

</div>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
