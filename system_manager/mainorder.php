<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
//  $filepath = realpath(dirname(__FILE__));
// include_once ($filepath.'/../classes/Order.php');
// $order = new Order();

?>


<?php 
//check if the get request for the shipid is set
 if (isset($_GET['shipid'])) {
	 //set the ship id to the order id variable
	$orderId = $_GET['shipid'];
	//call the shipped product method in the order class 
	//and pass the order id to process the order
 	$shipped = $order->shippedProduct($orderId);
 }


 //delete the order
  if (isset($_GET['delorderid'])) {
 	$orderId = $_GET['delorderid'];
	 //insert the order into the order history table before deleting
	$orderHistory = $order->insertOrderHistory($orderId); 
	//delete the order from the orders table in the database
	//and the product orders by passing the order id.
 	$deleteOrder = $order->deleteShippedOrderAdmin($orderId);
 }


?>

<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Customer Orders</h1>
          </div>
          <div class="container">
		  <?php
		  //check if shipped order is set
			if(isset($shipped)){
				echo $shipped;
			}
			//check if delete order is set 
			if(isset($deleteOrder)){
				echo $deleteOrder;
			}
		  ?>
              <div class="row">
                <div class="col-12">
				<h2>Orders</h2>
                <div class="table-responsive">  
				<?php
				//retrieve all user orders
				$getOrder = $order->getAllUserOrders();

				if($getOrder){
				?>   
				<table id="example" class="table table-striped">
					<thead>
						<tr>
							<th>Product ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>quantity</th>
							<th>Price</th>
							<th>Total Price</th>
							<th>Image</th>
							<th>Customer Id</th>
							<th>Customer Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php
					//iterate through the entire order
					while($result = $getOrder->fetch_assoc()){
					?>
					<tbody>
						<tr class="odd gradeX">
							<td><?php echo $result["product_id"];?></td>
							<td><?php echo $format->formatDate($result['date']);?></td>
							<td><?php echo $result["productName"] ?></td>
							<td><?php echo $result["quantity"];?></td>
							<td><?php echo $result["price"];?></td>
							<td><?php echo $result["totalPrice"];?></td>
							<td><img src="<?php echo $result['image']; ?>" class="img-fluid img-thumbnail" alt=""/></td>
							<td><?php echo $result["userId"];?></td>
							<td><a class="btn btn-outline-primary my-2 my-sm-0" href="customer.php?userId=<?php echo $result['userId'];?>">View Details</a></td>
							
							
							                                                                       
							<?php if($result['status'] == '0') { ?>
    							<td><a class="btn btn-outline-primary my-2 my-sm-0" href="?shipid=<?php echo $result['order_id'];?>">Shipped</a></td>
	 						<?php	} else {    ?>
								<td><a class="btn btn-outline-primary my-2 my-sm-0" href="?delorderid=<?php echo $result['order_id']; ?>">Remove</a></td>
                     		<?php } ?>
						</tr>
					</tbody>
					<?php }?>
				</table>
					<?php } else {?>
						<p>No orders to show.</p>
					<?php }?>
               </div>
              </div>
            </div>
          </div>  
        </main>
	<script type="text/javascript">
        $(document).ready(function() {
    		$('#example').DataTable();
			} );
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
<?php include 'inc/footer.php';?>
