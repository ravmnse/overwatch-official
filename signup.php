<!DOCTYPE HTML>
<html>
	<head>
		<title>Sign Up - Overwatch</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
        <?php
                    if(isset($_POST['create'])){
                        require("connection.php");
                        session_start();
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
                            $ins="INSERT INTO `ACCOUNTS` (`USER_ID`,`ROLE_ID`,`USERNAME`,`PSWORD`) values ($last_id,2,'$uname','$psw')";
                            mysqli_query($con,$ins);
                            
                            echo "<script> alert('Account Created!')</script>";
                            echo "<script>location.href='login.php'</script>";
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
								<li><a href="index.html">Home</a></li>
								<li>
									<a href="prod.php">Products</a>
									<ul>
										<li><a href="prod.php">Motion Detectors</a></li>
										<li><a href="prod.php">Biometrics</a></li>
										<li><a href="prod.php">RFID Locks</a></li>
										<li><a href="prod.php">CCTV Cameras</a></li>
												<li><a href="prod.php">AI Identification</a></li>
		
												<li><a href="prod.php">Smart Siren</a></li>
									</ul>
								</li>
								<li><a href="About.html">About Us</a></li>
								<li class="current"><a href="Account.html">Account</a></li>
							
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
                    <h2>Create New Account:</h2>
                </header>
                <form action="signup.php" method="post">  
                    <div class="container">
                        <label for="FNAME"><b>First Name</b></label>
                        <input type="text" placeholder="Enter Your First Name" name="FNAME" value="<?php echo $_POST['FNAME'] ?? ''; ?>" required>

                        <label for="MNAME"><b>Middle Name</b></label>
                        <input type="text" placeholder="Enter Your Middle Name" name="MNAME" value="<?php echo $_POST['MNAME'] ?? ''; ?>">

                        <label for="LNAME"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter Your Last Name" name="LNAME" value="<?php echo $_POST['LNAME'] ?? ''; ?>" required>

                        <label for="ADDRESS"><b>Home Address</b></label>
                        <input type="text" placeholder="House #, Street, City, Zip code" name="ADDRESS" value="<?php echo $_POST['ADDRESS'] ?? ''; ?>" required>

                        <label for="EMAIL"><b>Email Address</b></label>
                        <input type="text" placeholder="Enter Valid Email Address" name="EMAIL" value="<?php echo $_POST['EMAIL'] ?? ''; ?>" required>

                        <label for="MOBILE"><b>Mobile Number</b></label>
                        <input type="text" placeholder="Enter Your Mobile Number" name="MOBILE" value="<?php echo $_POST['MOBILE'] ?? ''; ?>" required>

                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $_POST['uname'] ?? ''; ?>" required>
                  
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $_POST['psw'] ?? ''; ?>" required>
                        <br>
                        <button type="submit" name="create">Sign Up</button>
                    </div>
                   
                    <br>
                    <div class="container" style="background-color:#f1f1f1">
                        <span class="signup">Already Have Account? <a href="login.php">Login</a></span>
                    </div>
                  </form>
            </section>
                        </div>
                    </div>
                </div> 
            </section>           
                
            <!-- Footer -->
            <section id="footer">
            <div class="container">
            <div class="row">
            <div class="col-8 col-12-medium">
                <section>
                    <header>
                        <h2>Keep up to date</h2>
                    </header>
                    <ul class="dates">
                        <li>
                            <span class="date">Nov <strong>27</strong></span>
                            <h3><a href="#">AI Learning: How can it affect your life?</a></h3>
                            <p>A webinar that we will be presenting regarding on AI and other automations in terms of security.</p>
                        </li>
                        <li>
                            <span class="date">Dec <strong>11</strong></span>
                            <h3><a href="#">Partnership Meetings</a></h3>
                            <p>Our corporate team will be out but we will try our best to get back on your concerns as soon as possible.</p>
                        </li>
                        <li>
                            <span class="date">Dec <strong>19</strong></span>
                            <h3><a href="#">December Special Sale</a></h3>
                            <p>Heads up! We will be having a 10-20% off on most of our security products and 50% off on some of our services.</p>
                        </li>
                        <li>
                            <span class="date">Jan <strong>12</strong></span>
                            <h3><a href="#">Start the year right Sale</a></h3>
                            <p>Be on the line for our exclusive offers soon!</p>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="col-4 col-12-medium">
                <section>
                    <header>
                        <h2>Why Overwatch?</h2>
                    </header>
                    <a href="#" class="image featured"><img src="images/pic10.jpg" alt="" /></a>
                    <p>
                        <strong>Overwatch</strong> is the one of the best security companies that will provide <strong>TOP OF THE LINE</strong> Security infrastructures and devices for your safety.
                    </p>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button">Find out more</a></li>
                        </ul>
                    </footer>
                </section>
            </div>
            <div class="col-4 col-6-medium col-12-small">
                <section>
                    <header>
                        <h2>Blogs</h2>
                    </header>
                    <ul class="divided">
                        <li><a href="#">25 Apps You Need to Have on Your Smartphone Right Now</a></li>
                        <li><a href="#">The Best Time to Buy Every Major Electronic</a></li>
                        <li><a href="#">5 Completely Crazy Predictions for Future of Tech</a></li>
                    </ul>
                </section>
            </div>
            <div class="col-4 col-6-medium col-12-small">
                <section>
                    <header>
                        <br>
                    </header>
                    <ul class="divided">
                        <li><a href="#">ARTIFICIAL INTELLIGENCE</a></li>
                        <li><a href="#">PRODUCT REVIEWS</a></li>
                        <li><a href="#">TECH CONFERENCES</a></li>
                    </ul>
                </section>
            </div>
            <div class="col-4 col-12-medium">
                <section>
                    <header>
                        <h2>Connect with us:</h2>
                    </header>
                    <ul class="social">
                        <li><a class="icon brands fa-facebook-f" href="#"><span class="label">Facebook</span></a></li>
                        <li><a class="icon brands fa-twitter" href="#"><span class="label">Twitter</span></a></li>
                        <li><a class="icon brands fa-dribbble" href="#"><span class="label">Dribbble</span></a></li>
                        <li><a class="icon brands fa-tumblr" href="#"><span class="label">Tumblr</span></a></li>
                        <li><a class="icon brands fa-linkedin-in" href="#"><span class="label">LinkedIn</span></a></li>
                    </ul>
                    <ul class="contact">
                        <li>
                            <h3>Address</h3>
                            <p>
                                Overwatch Incorporated<br />
                                1234 Somewhere Road Suite<br />
                                Nashville, TN 00000-0000
                            </p>
                        </li>
                        <li>
                            <h3>Mail</h3>
                            <p><a href="#">admin@overwatch.com</a></p>
                        </li>
                        <li>
                            <h3>Phone</h3>
                            <p>(800) 000-0000</p>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="col-12">

                <!-- Copyright -->
                    <div id="copyright">
                        <ul class="links">
                            <li>&copy; Overwatch. All rights reserved.</li><li>Design: BRYSE & AJ </li>
                        </ul>
                    </div>

            </div>
        </div>
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
