<?php include 'inc/pageHeader.php'; ?>
 
 <?php
 //get the user id for the current session
$userId = Session::get("userId"); 

//check if the get method was requested
  if (isset($_GET['delwlistid'])) {
//set the product id to the delwishlistid from the get request
  $productId = $_GET['delwlistid'];
  //pass the product id and user id to the delete wishlist method
  $delWlist = $wishList->deleteWlistData($productId, $userId);
  }
 ?>
 

 <div class="main">
    <div class="content">	
			<div class="table-responsive">
			    	<h2>Your WishList</h2>
  				
					<?php 
					//check if the delete wishlist is 
					//set and show the message
					if(isset($delWlist)){
						echo $delWlist; 
					}
					?>
					<?php 
					//get the user id
						$userId = Session::get("userId"); 
						//access the checkWListTable method and pass the user
						//id to return all the wishlist data for the specified user
						$getWlistData = $wishList->checkWlistTable($userId);

						//if data is returned, display the data below
						if($getWlistData){

					?>
						<table class = "table container center table-bordered  align-middle">
							<tr>
								<th width="5%">Sl</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								  
								<th width="10%">Action</th>
							</tr>
                    <?php
					//get the current userid from the current session
					$userId = Session::get("userId"); 
					//call the getWishListProuct method to get the wishlist products
					//based on the specified id
 					$getProduct = $wishList->getWishListProduct($userId);
					 //check if items are returned
 					if ($getProduct) {
 						$i = 0;
						
						 //make the data into an associatie array and 
						 //set the return value to result and iterate through it all
 						while ($result = $getProduct->fetch_assoc()) {
 							 $i++;
 						         ?>
 								<tr>
								<td><?php echo $i;  ?></td>
								<td><?php echo $result['productName'];  ?></td>
								<td><img src="<?php echo  "system_manager/".$result['image']; ?>" class="img-fluid img-thumbnail" alt=""/></td>
								<td>$ <?php echo $result['price'];  ?></td>
								 
								 
						 <td><a class ="btn btn-outline-success my-2 my-sm-0" href="preview.php?proid=<?php echo $result['productId']; ?>">Details</a> 
                          || <a class ="btn btn-outline-success my-2 my-sm-0" href="?delwlistid=<?php echo $result['productId']; ?>">Remove</a> 

						 </td>


							</tr>
 							 

							<?php } }   ?>
							 
							
						</table>
								         
							<?php } else{ //header("Location:index.php");}?>
							<p>Wishlist is currently empty.</p>
							<?php } ?>
					</div>
					<div class="row margin_control">
						<div class="col-6">
							<a href="index.php"> <img class="img-fluid max-width: 100% height: auto" src="system_manager/upload/images/shop.png" alt=""></a>
						</div>
					</div>
    	</div>  	
    </div>
</div>
   
    <?php include 'inc/footer.php'; ?>