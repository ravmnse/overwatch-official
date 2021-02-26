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
                            <li> Welcome <?php echo $user;?>!</li>
                            </ul>
							<ul>
								<li><a href="index2.php">Home</a></li>
								<li class="current"><a href="products.php">Products</a></li>
								<li><a href="about.php">About Us</a></li>
								<li><a href=#>Account</a>
                                <ul>
								<li><a href="profile.php">Profile</a></li>
								<li><a href="orders.php">Orders</a></li>
                                    <li><a href="logout.php">Logout</a></li>

                                </ul>  
								<li> <a href="cart.php"> <img src="images/cart.png" width="25px" height="25px"></a></li>
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
														echo ("In Stock: $x5");
												echo"</header>";
												echo"<p>$x3</p>";
												echo"<footer>";
													
													echo"<form action='addcart.php' method='post'>";
													echo"<ul class='actions'>";
													
														echo"<li><input type='text' name='qty' size=1 maxlength='4' value=1></li>";
																	echo"<li>";
																	echo"<input type='hidden' name='pid' value=$x1></li>";
																	echo"<button type='submit' name='add' class='button alt'>Add to cart</button>";
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
													echo ("In Stock: $x5");
													
											echo"</header>";
											echo"<p>$x3</p>";
											echo"<footer>";
												
												echo"<form action='addcart.php' method='post'>";
												echo"<ul class='actions'>";
												
													echo"<li><input type='text' name='qty' size=1 maxlength='4' value=1></li>";
																echo"<li>";
																echo"<input type='hidden' name='pid' value=$x1></li>";
																echo"<button type='submit' name='add' class='button alt'>Add to cart</button>";
												echo"</li>";
												echo"</ul>";
											echo"</form>";
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
													echo ("In Stock: $x5");
													
											echo"</header>";
											echo"<p>$x3</p>";
											echo"<footer>";
												
												echo"<form action='addcart.php' method='post'>";
												echo"<ul class='actions'>";
												
													echo"<li><input type='text' name='qty' size=1 maxlength='4' value=1></li>";
																echo"<li>";
																echo"<input type='hidden' name='pid' value=$x1></li>";
																echo"<button type='submit' name='add' class='button alt'>Add to cart</button>";
												echo"</li>";
												echo"</ul>";
											echo"</form>";
											echo"</footer>";
										echo"</section>";
									echo"</div>";
									echo"</div>";
									echo"</section>";


									}
								
									}

									?>


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