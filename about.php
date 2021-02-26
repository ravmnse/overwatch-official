<?php
session_start();
if(!isset($_SESSION['uname'])){
    header("Location:login.php");
die();
}
else{
   $user=$_SESSION['uname'];
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>About Us - Overwatch</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
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
										</li>
									</ul>
								</li>
								<li class="current"><a href="about.php">About Us</a></li>
								<li><a href=#>Account</a>
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

						<!-- Content -->
							<article class="box post">
								<a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
								<header>
									<h2>Who are we?</h2>
									<p>We are the Overwatch.</p>
								</header>
								<p>
									Established since 2010, We are aiming to reach the top and maintain our image to serve our clients the best experience to make their life better.
								</p>
								<p>
									With the partnership of different private companies, etc.
								</p>
								<section>
									<header>
										<h3>We'll take it from here.</h3>
									</header>
								</section>
							</article>

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