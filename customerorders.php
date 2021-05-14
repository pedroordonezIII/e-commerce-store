<?php include 'inc/pageHeader.php'; ?>
 
 <?php 
 //will check the session login
  $login =  Session::get("userLogin");
  //if no session is set, redirect to the login
  //page. Order page will not be accessible when logging out
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>


         <div class="main">
          <div class="content">
            	 
        <div class="section group">
        <div class="table-responsive"> 
          <h2> <span>Your Order History</span>  </h2>
          <?php
          //call the order details method and pass the userId 
           //to it to access the order details of the logged in
           //user
           $getOrder = $order->getOrderHistoryById($userId);
           //check if anything is returned
            if ($getOrder) {
          ?>
          <table  class = "table container center table-bordered  align-middle"">
              <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Status</th>
              </tr>

           <?php
           //get the user id for use current user in this session
           $userId = Session::get("userId"); 
           
            //set i = 0
            $i = 0;
            while ($result = $getOrder->fetch_assoc()) {
               $i++;
            ?>
                <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $result['orderId'];  ?></td>
                <td><?php echo $result['productName'];  ?></td>
                <td><img src="<?php echo "system_manager/".$result['productImage']; ?>" 
                class="img-fluid img-thumbnail" alt=""/></td>
                <td> <?php echo $result['quantity'];  ?></td>
                 
                <td>$ 
                  <?php echo $result["totalPrice"];?>      
                </td>

                 <td><?php echo $fm->formatDate($result['date']);  ?></td>
              
                <td>

                  <?php
                  //check the order status field to check the status
                  //if the status is 0, it is pending, else it is shipped
                  if ($result['status'] == '1') {
                   echo "Shipped";
                  }
                     ?>
                     
                  </td>

                
              </tr>
              <?php } ?>
               
              
            </table>
            <?php } else{?>
              <span><p>No order history.</p></span>
            <?php }?>
          </div>
          <div class="row margin_control">
						<div class="col-6">
							<a href="index.php"> <img class="img-fluid max-width: 100% height: auto" src="system_manager/upload/images/shop.png" alt=""></a>
						</div>
					</div>
        </div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>
   