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
		<title>Orders - Overwatch</title>
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
								<li><a href="about.php">About Us</a></li>
                                
								<li class="current"><a href=#>Account</a>
                                <ul>
                                <li><a href="profile.php">Profile</a></li>
                                    <li ><a href="orders.php">Orders</a></li>
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

            <!-- Account -->
            <section>
            <header class="major">
                    <h2>My Orders</h2>
                </header>
                <?php
                    $query5="SELECT * FROM ORDERS WHERE USERNAME='$user'";
                    $results3=mysqli_query($con,$query5);

                    $count2=mysqli_num_rows($results3);
                    if($count2>=1){
                        while($r=mysqli_fetch_array($results3)){
                            $gt2=0;
                            $oid=$r['ORDER_ID'];
                            $odate=$r['ORDER_DATE'];
                            $ostat=$r['ORDER_STATUS'];
                            echo"<table>";
                            echo"<tr><th>Order Id: $oid</th><th>Order Date: $odate</th><th>Order Status:$ostat</th></tr>";
                            echo"<tr><th>ITEM ID</th><th>ITEM NAME</th><th>PRICE</th><th>QUANTITY</th><th>SUB TOTAL</th></tr>";
                            $query6="SELECT A.ITEM_ID,A.ITEM_NAME,A.ITEM_IMG_NAME,A.PRICE,A.QUANTITY,A.QUANTITY*A.PRICE AS SUBTOTAL FROM (SELECT O.ORDER_ID,O.ITEM_ID,I.ITEM_NAME,I.ITEM_IMG_NAME,I.PRICE,O.QUANTITY FROM ITEM_ORDERS AS O INNER JOIN ITEM AS I ON O.ITEM_ID=I.ITEM_ID WHERE O.ORDER_ID=$oid) AS A";
                            $results4=mysqli_query($con,$query6);
                            while($r2=mysqli_fetch_array($results4)){
                                $c1=$r2['ITEM_ID'];
                                $c2=$r2['ITEM_NAME'];
                                $c0=$r2['ITEM_IMG_NAME'];
                                $c3=$r2['QUANTITY'];
                                $c4=$r2['PRICE'];
                                $c5=$r2['SUBTOTAL'];
                                $gt2+=$c5;
                                echo "<tr><td>$c1</td><td><img src='images/$c0' width='100px' height='75px'><br>$c2</td><td>$c4</td><td>$c3</td><td>$c5</td>";
                            }
                            echo "<tr><td colspan='4'></td><td>Grand Total: ₱$gt2</td><td></td></tr>";

                        }

                        
                    }
                    else{
                        echo"No recorded order!";
                    }
                ?>


                    <div class="container">
            
                 

            </section>
                        </div>
                    </div>
                </div> 
            </section>           
                
            
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
