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
		<title>Cart - Overwatch</title>
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
                                
								<li><a href=#>Account</a>
                                <ul>
                                <li><a href="profile.php">Profile</a></li>
                                    <li><a href="orders.php">Orders</a></li>
                                    <li><a href="logout.php">Logout</a></li>

                                </ul>  
								<li class="current"> <a href="cart.php"> <img src="images/cart.png" width="25px" height="25px"></a></li>
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
                    <h2>Cart</h2>
                </header>
                
                    <div class="container">
                <?php
                $gt=0;
                
                $query="SELECT A.ITEM_ID, A.ITEM_NAME,A.ITEM_IMG_NAME,A.QUANTITY,A.PRICE,A.QUANTITY*A.PRICE AS SUBTOTAL FROM (SELECT C.USERNAME,C.ITEM_ID,I.ITEM_NAME,I.ITEM_IMG_NAME,C.QUANTITY,I.PRICE FROM CART AS C INNER JOIN ITEM AS I ON C.ITEM_ID=I.ITEM_ID WHERE C.USERNAME='$user') AS A";
                $results=mysqli_query($con,$query);
                
                $count= mysqli_num_rows($results);
                echo"<table><th>ITEM ID</th><th>ITEM NAME</th><th>PRICE</th><th>QUANTITY</th><th>SUB TOTAL</th><th></th></tr>";
                if($count>=1){
                    while($row=mysqli_fetch_array($results)){
                        echo"<form action='cart.php' method='post'>";
                        $id=$row['ITEM_ID'];
                        $name=$row['ITEM_NAME'];
                        $img=$row['ITEM_IMG_NAME'];
                        $qty=$row['QUANTITY'];
                        $prc=$row['PRICE'];
                        $total=$row['SUBTOTAL'];
                        $gt+=$total;
                        echo "<tr><td>$id</td><td><img src='images/$img' width='100px' height='75px'><br>$name</td><td>$prc</td><td>$qty</td><td>$total</td><td><button type='submit' name='del'>Remove</button></td><td></td></tr>";
                        echo"<input type='hidden' name='prod' value='$id'>";

                    }
                    echo "<tr><td colspan='4'></td><td>Grand Total: ₱$gt</td><td></td><td></td></tr>";
                    echo"</form>";
                    echo"<form method='post'>";
                    echo"<tr><td colspan='6'><td/></tr>";
                    echo"<tr><td colspan='4'><td/><td><button type='submit' name='porder'>Place Order</button></td><td></td></tr>";
                    echo"</form>";
                   
                   
                }
                else{
                    echo "<tr><td colspan='6'>Your Cart is Empty!</td></tr>";
                }
                echo"</table>";

                
                ?>   
                 
                 <?php
    if(isset($_POST['del'])){
        $x=$_POST['prod'];
      
        $rem="DELETE FROM CART WHERE USERNAME='$user' AND ITEM_ID=$x";
        mysqli_query($con,$rem);

        $query2="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',5,CURRENT_TIMESTAMP())";
        mysqli_query($con,$query2);
        header("Location:cart.php");
    }

    ?>

<?php
    if(isset($_POST['porder'])){
        $ins="INSERT INTO `ORDERS` (`ORDER_DATE`,`ORDER_STATUS`,`USERNAME`) VALUES(CURRENT_TIMESTAMP(),'In-Process','$user')";
        mysqli_query($con,$ins);
        $last_id = mysqli_insert_id($con);
        $query="SELECT * FROM CART WHERE USERNAME='$user'";
        $results=mysqli_query($con,$query);
        while($row=mysqli_fetch_array($results)){
            $item=$row['ITEM_ID'];
            $quan=$row['QUANTITY'];
            $ins2="INSERT INTO `ITEM_ORDERS` VALUES($last_id,$item,$quan)";
            mysqli_query($con,$ins2);
            $query2="SELECT * FROM ITEM WHERE ITEM_ID=$item";
            mysqli_query($con,$ins2);
            $results2=mysqli_query($con,$query2);
            $row2=mysqli_fetch_array($results2);
            $old=$row2['STOCK'];
            $new=$old-$quan;
            $query3="UPDATE ITEM SET STOCK=$new WHERE ITEM_ID=$item";
            mysqli_query($con,$query3);
            $query4="DELETE FROM CART WHERE USERNAME='$user' AND ITEM_ID=$item";
            mysqli_query($con,$query4);

        }
        $ins3="INSERT INTO `ACCOUNT_AUDIT` (`USERNAME`,`ACTION_ID`,`AUD_DATE`) values ('$user',6,CURRENT_TIMESTAMP())"; 
        mysqli_query($con,$ins3);
        header("Location:orders.php");
    }



    ?>
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
