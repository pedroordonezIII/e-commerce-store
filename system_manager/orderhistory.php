<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
//  $filepath = realpath(dirname(__FILE__));
// include_once ($filepath.'/../classes/Order.php');
// $order = new Order();

?>

<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Customer Order History</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
				<h2>Orders</h2>
                <div class="table-responsive">  
				<?php
						
				$getOrder = $order->getAllOrderHistory();

				if($getOrder){
				?>   
				<table id="example" class="table table-striped">
					<thead>
						<tr>
                            <th>Order ID</th>
							<th>Product ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>quantity</th>
							<th>Price</th>
							<th>Total Price</th>
							<th>Image</th>
							<th>Customer Id</th>
							<th>Customer Details</th>
							<th>Status</th>
						</tr>
					</thead>
					<?php

					while($result = $getOrder->fetch_assoc()){
					?>
					<tbody>
						<tr class="odd gradeX">
                            <td><?php echo $result["orderId"];?></td>
							<td><?php echo $result["productId"];?></td>
							<td><?php echo $format->formatDate($result['date']);?></td>
							<td><?php echo $result["productName"] ?></td>
							<td><?php echo $result["quantity"];?></td>
							<td><?php echo $result["price"];?></td>
							<td><?php echo $result["totalPrice"];?></td>
							<td><img src="<?php echo $result['productImage']; ?>" class="img-fluid img-thumbnail" alt=""/></td>
							<td><?php echo $result["userId"];?></td>
							<td><a class="btn btn-outline-primary my-2 my-sm-0" href="customer.php?userId=<?php echo $result['userId'];?>">View Details</a></td>
							                                                           
							<?php if($result['status'] == '1') { ?>
    							<td>Shipped</a></td>
                            <?php }?>
					</tbody>
					<?php }?>
				</table>
					<?php } else {?>
						<p>No order history to show.</p>
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