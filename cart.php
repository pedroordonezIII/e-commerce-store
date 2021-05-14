<?php
include("inc/pageheader.php"); 
?>

<?php 
   
   //check for the post method for the update quantity
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   //set the cart id based on the post method array value
       $cartId = $_POST['cartId'];
	   //set the quantity based on the post method array value
	   $quantity= $_POST['quantity'];

	   //call the update cart quantity method to update the cart quantity
	   //based on the cart id.  
       $updateCart = $cart->updateCartQuantity($quantity, $cartId);

	   //if quantity is less than or equal to zero, delete the 
	   //item with the cart id.
	   if($quantity <= 0){
		 //delete cart item method in the cart class that takes a cart id
		$deleteItem = $cart->deleteCartItem($cartId);
	   }
   }  
   
   //cehck if the get request is set for the productId to delete the item
   if(isset($_GET['delcartid'])){

	//set product ID to the get method proid array field
	$delcartId = $_GET["delcartid"]; 

	//delete the item from the cart by calling the deleteCartItem Method
	//in the cart object class and pass the productId
	$deleteItem = $cart->deleteCartItem($delcartId); 
   }

?>

<?php

//check if the id is not set
if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
}
?>

<div>
    <div>
    	<div>		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

					<?php
					//show message returned by the update method
					if(isset($updateCart)){
						echo $updateCart;
					}
					?>

					<?php
					//show message returned by the delete method
					if(isset($deleteItem)){
						echo $deleteItem;
					}
					?>
						<?php 
							//access the checkCartTable() in the cart objecct method
							$getData = $cart->checkCartTable(); 
							//Must check if cart has items, so if the table returns something,
							//the subtotal and grandtotal will be displayed, if nothing is in the cart
							//these variables will not be set.
                            if($getData){ 
						?>
						<div class="table-responsive">
						<table class = "table container center table-bordered  align-middle">
							<tr>
								<th width="5%">Sl</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							//instantiate getProduct variable from the 
							//cart class object method getcartproduct
							$getProduct = $cart->getCartProduct();
							if($getProduct){
							//variable for SI
							$i = 0; 
							//sum for the price
							$sum = 0;
							$totalQty = 0;
							while($result = $getProduct->fetch_assoc()){
							//increment after each iteration
							$i++;
							?>
 							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $result["productName"]?></td>
								<td><img src="<?php echo "system_manager/".$result["image"];?>" 
								class="img-fluid img-thumbnail"></td>
								<td>$<?php echo $result["price"]?></td>
								<td width="10%">
								<form action="" method="post">
		                            <input type="hidden" name="cartId" value="<?php echo $result["cartId"];?>">
		                            <input type="number" name="quantity" value="<?php echo $result["quantity"];?>">
									<input type="submit" name="submit" value="Update"/>
								</form>
								</td>
								<td>$
									<?php
									//show the total price based on the quantity and price of the item 
									$total = $result["price"] * $result["quantity"]; 
									$total = round($total, 2); 
									//show the total
									echo $total; 
									?>
								</td>
								<td><a onclick="return confirm('Are you sure you want to delete?');" href="cart.php?delcartid=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
							<?php
							$sum = $sum + $total; 
							$totalQty = $totalQty + $result["quantity"];
							//since the session is intialized in the header,
							//the set method is set based on the intialized session
							Session::set("sum", $sum); 
							//set the total for the session
							Session::set("total", $total);
							//set the quantity for the session
							Session::set("quantity", $totalQty); 

							?>
							<?php } }?>
						</table>
						<span>Press update button to update quantity.</span>
						</div>
						<table class="table_style">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php echo $sum ?></td>
							</tr>
							<tr>
								<th>Tax : </th>
								<td>   
									10%
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$ 
								<?php 
									$tax = $sum*0.1;
									$tax = round($tax, 2);  
									$grandTotal = $sum + $tax;
									echo $grandTotal; 
								?>
								</td>
							</tr>
					   </table>
					   <div class="row margin_control">
							<div class="col-6 float-left">
								<a href="index.php"> <img class="img-fluid max-width: 100% height: auto" src="system_manager/upload/images/shop.png" alt=""></a>
							</div>
							<div class="col-6">
								<a href="offline.php"> <img class="img-fluid max-width: 100% height: auto" src="system_manager/upload/images/check.png" alt=""></a>
							</div>
						</div>
					   <?php } else{ //header("Location:index.php");?>
					   <span>Cart is currently empty.</span>
					   <div class="row margin_control">
							<div class="col-6 float-left">
								<a href="index.php"> <img class="img-fluid max-width: 100% height: auto" src="system_manager/upload/images/shop.png" alt=""></a>
							</div>
						</div>
					   <?php }?>
					</div>
				</div>
    	</div>  	
    </div>
 </div>
</div>
   
<?php
include("inc/footer.php"); 
?>