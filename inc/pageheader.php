
<?php
ob_start();

 include 'lib/Session.php';
 //start session when accessing pages
 //session set and get can be initialized in all pages
 Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';

 /**
  * This built in function takes a function
  that allows all the classes in the classes 
  folder to be included
  */
  spl_autoload_register(function($class){
   include_once "classes/".$class.".php";

  });

// include 'classes/Product.php';
// include 'classes/Category.php';
// include 'classes/Brand.php';
// include 'classes/Cart.php';

/**
 * Create an object for all the classes
 * that will be accessible in all of the 
 * pages since pageheader is all included
 */
  $db = new Database();
  $brand = new Brand();
  $fm = new Format();
  $product = new Product();
  $category = new Category();
  $cart= new Cart();
  $user = new User();
  $wishList = new WishList();
  $contact = new Contact(); 
  $order = new Order();

ob_flush();
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="public/style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
 crossorigin="anonymous"/>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
 crossorigin="anonymous"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
crossorigin="anonymous"></script>
</head>
<style>
.cart_product{
    font-size: 14px; 
    color: red;
}
</style>
<body id="style">
  <div class="container card border-success mb-3" id="container">
		<div class="row">
			<div class="col-sm">
                <a href="index.php"><img alt="Responsive image" src="system_manager/upload/images/supplementLogo.jpg" alt="" /></a>
			</div>
			<div class="col-sm">
                <nav class="navbar-expand-sm navbar justify-content-between">
                 <form class="form-inline" action="search.php" method="get">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search Products" aria-label="Search">
                    <button class="btn btn-outline-success btn-sm my-2 my-sm-0" value="SEARCH" type="submit">Search</button>
                 </form>
                </nav>
            </div>
				<div class="col-sm">
					<a  class="btn btn-outline-success my-2 my-sm-0" href="cart.php" title="View my shopping cart" rel="nofollow">
					    <span class="cart_title">Cart</span>
						<span class="cart_product">
                        <?php 
                            
                            //call the checkCartTable method that returns
                            //the rows of the table if something is in the 
                            //table
                            $getData = $cart->checkCartTable(); 
                            //if table has data, get the session data and display it
                            if($getData){
                            //get the sum for the session
                            $sum = Session::get("sum");
                            //get the quanity of items set for the session
                            $quantity = Session::get("quantity");
                            echo "$".$sum." Qty:".$quantity; 
                            } else{
                                //show that the table is empty 
                                echo "(Empty)";
                            }
								?> 
						</span>
					</a>
				</div>

            <?php
                //check if the get request is set
                if(isset($_GET["userid"])){
                    //call method in cart class to delete
                    //cart data upon logging out
                    $delData = $cart->deleteCustomerCart(); 

                    //destroy the session if the ID is obtained
                    //the redirection screen location will be the login.php page 
                    Session::destroy(); 
                }
            ?>

		   <div class="col-sm">
           <?php 
            //will set login equal to the value returned by the 
            //get method when the userLogin key is passed to it
            //either the key value or false
            $login =  Session::get("userLogin");
            //if not session is set, show the login button which redirects to the login page is shown
            //if session is set, the logout button will show
            if ($login == false) {?>
                <a class="btn btn-outline-success my-2 my-sm-0" href="login.php" role="button">Login</a>
           <?php } else {?>
                <a class="btn btn-outline-success my-2 my-sm-0" href="?userid=<?php Session::get('userId');?>" role="button">Logout</a>
             <?php }  ?>
		   </div>
           <div class="col-12 style_margin">
           <?php 
            //will set login equal to the value returned by the 
            //get method when the userLogin key is passed to it
            //either the key value or false
            $login =  Session::get("userLogin");
            //if no session is set, show the register button which redirects to the login page is shown
            //if session is set, the button will not show
            if ($login == false) {?>
                <a class="btn btn-outline-success my-2 my-sm-0" href="register.php" role="button">Register</a>
           <?php } ?>
		   </div>
	    </div>
        <div>
        <nav class="navbar sticky-top navbar-expand-lg justify-content-between navbar-dark bg-dark">
        <a class="navbar-brand"></a>
             <button class="navbar-toggler" data-toggle="collapse" data-target="#expandme">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="expandme">
                <div class="navbar-nav">
                     <a href="index.php" class="nav-item nav-link">Home</a>

                     <a href="cart.php" class="nav-item nav-link">Cart</a>

                     <?php 
                    
                    //call checkCartTable method in the cart class
                    //to check if cart table has anything inside of it
                    $checkCart = $cart->checkCartTable(); 

                    //if something is returned, display the cart button
                    if($checkCart){
                    ?>
                    <a href="offline.php" class="nav-item nav-link">Payment</a>
                    <?php  }?>

                    <?php 
                    //get user id 
                     $userId = Session::get("userId"); 
                    //call checkOrderTable method in the cart class
                    //to check if cart table has anything inside of it
                    $checkOrder = $order->checkOrderTable($userId); 

                    //if something is returned, display the cart button
                    if($checkOrder){
                    ?>
                    <a href="order.php" class="nav-item nav-link">Order</a>
                    <?php  }?>

                    <?php
                    //get the login ,which should be true if user is logged in
                    $login = Session::get("userLogin");

                    $getOrder = $order->getOrderHistoryById($userId);

                    if($login == true && $getOrder){
                    ?>
                    <a href="customerorders.php" class="nav-item nav-link">Order History</a>
                    <?php }?>


                     
                     <?php
                        //get the login ,which should be true if user is logged in
                         $login =  Session::get("userLogin");
                         //get the userId for the user for the current session
                         $userId = Session::get("userId"); 
                        //call the checkWlistTable mehtod to return the rows 
                        //of the wishlist based on the user id
                         $checkWlist = $wishList->checkWlistTable($userId);
                        
                         //check if the login is equal to true condition to make
                         //the profile button visible if user is logged in only
                         if($login == true){?>
                            <a href="profile.php" class="nav-item nav-link">Profile</a>
                            <a href="wishlist.php" class="nav-item nav-link">Wishlist</a>
                         <?php }?>

                     <a href="products.php" class="nav-item nav-link">All Products</a>
                     <a href="contact.php" class="nav-item nav-link">Contact</a>
                     <a href="about.php" class="nav-item nav-link">About Us</a>
                 </div>
            </div>
        </nav>
        </div>