<?php
	require("connection.php");

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Products - Overwatch</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="Pricing is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">

					<!-- Logo -->
						<h1><a href="index.html">OVERWATCH</a></h1>

					<!-- Nav -->
							<nav id="nav">
                           
							<ul>
								<li><a href="index.html">Home</a></li>
								<li class="current"><a href="prod.php">Products</a></li>
								<li><a href="About.html">About Us</a></li>
								<li><a href="Account.html">Account</a>
                                
							</ul>
						</nav>
				</section>

			<!-- Main -->
			<section id="main">
				<div class="container">
					<div class="row">
						<div class="col-12">
						<section>
									<header class='major'>
									<h2>Our Products:</h2>
									</header>
									<div class='row'>
								<!-- All Products -->
								
									<?php
									/*echo"<section>";
									echo"<header class='major'>";
									echo"	<h2>Our Products:</h2>";
									echo"</header>";
									echo"<div class='row'>";*/
									$query="Select * FROM ITEM"; 
									$res=mysqli_query($con,$query);
									$count= mysqli_num_rows($res);
									$i=1;

									while($row=mysqli_fetch_array($res)){
									$x1=$row['ITEM_ID'];
									$x2=$row['ITEM_NAME'];
									$x3=$row['ITEM_DESC'];
									$x4=$row['ITEM_IMG_NAME'];
									$x5=$row['STOCK'];
									

									if($i%3!=0 && $i!=$count){
										echo"<div class='col-4 col-6-medium col-12-small'>";
											echo"<section class='box'>";
												echo"<a href='#' class='image featured'><img src='images/$x4' alt='$x4' /></a>";
												echo"<header>";
													echo"<h3>$x2</h3>";
												echo"</header>";
												echo"<p>$x3</p>";
												echo"<footer>";
													echo"<ul class='actions'>";
																	echo"<li>";
																	echo"<li><a href='login.php' class='button alt'>Shop Now!</a></li>";
													echo"</li>";
													echo"</ul>";
												echo"</form>";
												echo"</footer>";
											echo"</section>";
										echo"</div>";
										$i++;
									}
									elseif($i%3==0 && $i!=$count){
										echo"<div class='col-4 col-6-medium col-12-small'>";
										echo"<section class='box'>";
											echo"<a href='#' class='image featured'><img src='images/$x4' alt='' /></a>";
											echo"<header>";
												echo"<h3>$x2</h3>";
													
													
											echo"</header>";
											echo"<p>$x3</p>";
											echo"<footer>";
												
												
												echo"<ul class='actions'>";
												
												
																echo"<li>";
													
																echo"<li><a href='login.php' class='button alt'>Shop Now!</a></li>";
												echo"</li>";
												echo"</ul>";
										
											echo"</footer>";
										echo"</section>";
									echo"</div>";
									echo"</div>";
									echo"</section>";
									echo"<section>";
									echo"<div class='row'>";
									$i++;
									}
									else{
										echo"<div class='col-4 col-6-medium col-12-small'>";
										echo"<section class='box'>";
											echo"<a href='#' class='image featured'><img src='images/$x4' alt='' /></a>";
											echo"<header>";
												echo"<h3>$x2</h3>";
													
													
											echo"</header>";
											echo"<p>$x3</p>";
											echo"<footer>";
												
												
												echo"<ul class='actions'>";
												
												
																echo"<li>";
													
																echo"<li><a href='login.php' class='button alt'>Shop Now!</a></li>";
												echo"</li>";
												echo"</ul>";
											
											echo"</footer>";
										echo"</section>";
									echo"</div>";
									echo"</div>";
									echo"</section>";


									}
								
									}


									?>
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