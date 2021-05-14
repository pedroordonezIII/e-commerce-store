
<?php

//check for the userid get method
if(isset($_GET["userid"])){
	//delete the customer cart before logging out
	$delData = $cart->deleteCustomerCart(); 

	//destroy the session
	Session::destroy(); 
}
?>
	<div>
   	  <div>	
	     <div class="container-fluid bg-dark text-white" id="style">
			<div class="row">
                <div class="col-sm">
					<h4>Information</h4>
					<ul>
					<li><a class="text-white" href="about.php">About Us</a></li>
					<li><a class="text-white" href="contact.php">Customer Service</a></li>
					<?php 
					 //get user id 
                     $userId = Session::get("userId"); 
                    //call checkOrderTable method in the cart class
                    //to check if cart table has anything inside of it
                    $checkOrder = $order->checkOrderTable($userId); 

                    //if something is returned, display the cart button
                    if($checkOrder){?>
						<li><a class="text-white" href="order.php">My Orders</a></li>
						<?php }?>
					<li><a class="text-white" href="contact.php"><span>Contact Us</span></a></li>
					</ul>
				</div>
				<div class="col-sm text-white">
					<h4>Why buy from us</h4>
					<ul>
					    <li><a class="text-white" href="about.php">About Us</a></li>
					</ul>
				</div>
				<?php 
				$userId = Session::get("userId"); 
            	$login =  Session::get("userLogin");

				//get the wishlist content using the user Id for the session
				$getWlist = $wishList->checkWlistTable($userId);

				//get the user cart based on the session id
				$getCart = $cart->checkCartTable(); 

				//
				$checkOrder = $order->checkOrderTable($userId); 

            	//if not session is set, show the login button which redirects to the login page is shown
            	//if session is set, the logout button will show
            	if ($login) {?>
				<div class="col-sm text-white">
					<h4>My account</h4>
					<ul>
						<li><a class="text-white" href="?userid=<?php Session::get('userId');?>">Logout</a></li>
						<li><a class="text-white" href="cart.php">My Cart</a></li>
						<?php if($checkOrder){?>
							<li><a class="text-white" href="order.php">My Orders</a></li>
						<?php }?>

						<li><a class="text-white" href="wishlist.php">My Wishlist</a></li>
						<li><a class="text-white" href="profile.php">User Profile</a></li>
						<li><a class="text-white" href="editprofile.php">Edit Profile</a></li>
						<li><a class="text-white" href="editpayment.php">Edit Payment</a></li>
						<li><a class="text-white" href="contact.php">Help</a></li>
				    </ul>
				</div>
				<?php } else {?>
					<div class="col-sm text-white">
					<h4>My account</h4>
					<ul>
						<li><a class="text-white" href="login.php">Sign In</a></li>
						<li><a class="text-white" href="register.php">Register</a></li>
						<?php //if($getCart){?>
						<li><a class="text-white" href="cart.php">My Cart</a></li>
						<?php //}?>
						<?php if($checkOrder){?>
							<li><a class="text-white" href="order.php">My Orders</a></li>
						<?php }?>
						<li><a class="text-white" href="contact.php">Help</a></li>
				    </ul>
				</div>
				<?php }?>
				<div class="col-sm">
					<h4>Contact</h4>
					<ul>
						<li><span>000-000-0000</span></li>
						<li><span>ecommercecsci675@gmail.com</span></li>
					</ul>
				</div>
            </div>
		</div>
    </div>
</div>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
</body>
</html>