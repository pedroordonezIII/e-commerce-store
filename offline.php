<?php include 'inc/pageheader.php'; ?>
 
 <?php 
 //get the user login of the user
  $login =  Session::get("userLogin");
  //if the user is not logged in, redirect to the login page
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>

  <?php

   //check if the get request for the order is set
  if(isset($_GET["orderid"]) && $_GET["orderid"] == "order"){
    
    $userId = Session::get("userId");

    $orderInsert = $order->orderProduct($userId);
    //delete all the cart by accessing this method from 
    //the cart class
    $delData = $cart->deleteCustomerCart();
    header("Location:success.php");
  } else if(isset($_GET["orderid"]) && $_GET["orderid"] == "error"){

    $updateDetails = "<span class='error'>Must update order details to order products.</span>";
  }
 ?>
 

 <div class="main">
    <div class="content">
    <div class="container section group"> 
       <?php 
          if(isset($updateDetails)){
            echo $updateDetails;
          }
          ?>

        <div class="table-responsive">
            <table class = "table table-bordered border-success tblone">
              <tr>
                <td>#</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
                
              </tr>
              <?php
              //get the cart products to display the payment
              $getProduct = $cart->getCartProduct();

              //check if something is returned
              if($getProduct){
                //instantiate variables
                $i = 0; 
                $sum = 0;
                $qty = 0;
                //loop through the returned associative array
                while($result = $getProduct->fetch_assoc()){
                //increment number
                $i++;
              ?>
                <tr>
                <td><?php echo $i;  ?></td>
                <td><?php echo $result['productName'];  ?></td>
                
                <td>$ <?php echo $result['price'];  ?></td>
                 <td> <?php echo $result['quantity'];  ?></td>
                <td>$
                <?php 
                    //get the total price for each row by multiplying the 
                    //row price by the quantity
                   $total = $result['price'] * $result['quantity'];
                   $total = round($total, 2); 
                   //display the total in the row
                   echo $total;
                  ?>   
                </td>
              </tr>
              <?php 
                //after updating row content, update the total quantity by
                //adding the current quantity total by the quantity total for
                //the current row
                 $qty = $qty +  $result['quantity'];
                 //after updating row content, keep a running total for the 
                 //sum price of all the items by adding the current sum amount
                 //to the total from the row that was just accessd
                 $sum = $sum + $total;
               ?>
               <?php } ?>
            </table>
        </div>          
        
        <div class="row">
        <div class="table-responsive col">
            <table class = "table table-bordered border-success">
              <tr>
                <th>Sub Total : </th>
                <td>$ <?php echo $sum;  ?></td>
              </tr>
              <tr>
                <th>Tax : </th>
                <td>   
                  <?php $tax = $sum * 0.1; 
                  $tax = round($tax, 2); 
                  ?>
                   10% (<?php echo $tax;?> )
                </td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>$<?php 
                  $tax = $sum * 0.1;
                  $tax = round($tax, 2); 
                  $gtotal = $sum + $tax;
                   echo $gtotal;
                  ?> </td>
              </tr>


                 <tr>
                <th>Quantity :</th>
                <td> <?php echo $qty; ?></td>
              </tr>
             </table>
             <?php }?>
        </div>
        </div>
        <div class="row">
        <div class="table-responsive col-sm">  
        <?php 
        
        //get the current user login value
        $userLogin = Session::get("userLogin"); 
        
        //check if the value is true 
        if($userLogin){
          
          //if logged in , get the current user id for the
          //session
          $userId = Session::get("userId");

          //pass the user id to the getCustomer data 
          //to get the customer data based on the userId in the session
          $customerData = $user->getCustomerData($userId); 
          
          if($customerData){
          //iterate through the user information 
          while($result = $customerData->fetch_assoc()){
        ?>
            <table class="table table-bordered border-success">
                <tr>
                    <td colspan="3"> <h3>Profile Details</h3></td>
                </tr>
                <tr>
                    <td width="20%"> Name  </td>
                    <td width="5%"> : </td>
                    <td> <?php echo $result['name']; ?>  </td>
                 </tr>
                <tr>
                    <td> Phone  </td>
                    <td> : </td>
                    <td> <?php echo $result['phone']; ?> </td>
                </tr>
                <tr>
                     <td> Email  </td>
                    <td> : </td>
                    <td> <?php echo $result['email']; ?>  </td>
                </tr>
                <tr>
                    <td> Address  </td>
                    <td> : </td>
                    <td> <?php echo $result['address']; ?>  </td>
                </tr>
                <tr>
                    <td> City  </td>
                    <td> : </td>
                    <td><?php echo $result['city']; ?>  </td>
                </tr>
                <tr>
                    <td> Zipcode  </td>
                    <td> : </td>
                    <td> <?php echo $result['zip']; ?>  </td>
                </tr>
                <tr>
                    <td> Country  </td>
                    <td> : </td>
                    <td> <?php echo $result['country']; ?>  </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>  </td>
                    <td><a class="btn btn-outline-success my-2 my-sm-0" href="editprofile.php"> Update Details </a> </td>
                </tr>
            </table>
        <?php } } } ?> 
        </div>
        <div class="table-responsive col-sm">  
        <?php 
        
        //get the current user login value
        $userLogin = Session::get("userLogin"); 
        
        //check if the value is true 
        if($userLogin){
          
          //if logged in , get the current user id for the
          //session
          $userId = Session::get("userId");

          //pass the user id to the getCustomer data 
          //to get the customer data based on the userId in the session
          $payment = $user->getPaymentData($userId); 
          
          if($payment){

            while($userPayment = $payment->fetch_assoc()){
        ?>
      <table class="table container center table-bordered  align-middle">
         <tr>
            <td colspan="3"> <h3> Payment Details </h3> </td>
         </tr>
         <tr>
            <td width="20%"> Card Name </td>
            <td width="5%"> : </td>
            <td><?php echo $userPayment["cardname"];?></td>
         </tr>
         <tr>
            <td> Card number  </td>
            <td> : </td>
            <td><?php echo $userPayment["cardnumber"];?></td>
         </tr>
         <tr>
            <td> Exp Month </td>
            <td> : </td>
            <td><?php echo $userPayment["expmonth"];?> </td>
         </tr>
         <tr>
            <td> Exp Year  </td>
            <td> : </td>
            <td> <?php echo $userPayment["expyear"];?> </td>
         </tr>
         <tr>
            <td> CVV  </td>
            <td> : </td>
            <td><?php echo $userPayment["cvv"];?></td>
         </tr>
         <tr>
            <td>   </td>
            <td>  </td>
            <td>
            <a  class="btn btn-outline-success my-2 my-sm-0" href="editpayment.php">Update Details
            </td>
         </tr>
      </table>
      <?php } } else {?>
         <table class="table container center table-bordered  align-middle">
         <tr>
            <td colspan="3"> <h3> Payment Details </h3> </td>
         </tr>
         <tr>
            <td width="20%"> Card Name </td>
            <td width="5%"> : </td>
            <td></td>
         </tr>
         <tr>
            <td> Card number  </td>
            <td> : </td>
            <td></td>
         </tr>
         <tr>
            <td> Exp Month </td>
            <td> : </td>
            <td></td>
         </tr>
         <tr>
            <td> Exp Year  </td>
            <td> : </td>
            <td></td>
         </tr>
         <tr>
            <td> CVV  </td>
            <td> : </td>
            <td></td>
         </tr>
         <tr>
            <td>   </td>
            <td>  </td>
            <td>
            <a  class="btn btn-outline-success my-2 my-sm-0" href="editpayment.php">Update Details
            </td>
         </tr>
      </table>
      <?php } } ?>
        </div>
        </div>
        <?php 
        $userId = Session::get("userId");

        //pass the user id to the getCustomer data 
        //to get the customer data based on the userId in the session
        $payment = $user->getPaymentData($userId); 
        
        if($payment){
        ?>
        <div class="back"> 
          <a class="btn btn-outline-success my-2 my-sm-0" href="?orderid=order"> Order </a>
        </div>
        <?php } else {?>
        <div class="back"> 
          <a class="btn btn-outline-success my-2 my-sm-0" href="?orderid=error"> Order </a>
        </div>
        <?php }?>
    </div>
 </div>
</div>
</div>
<?php include 'inc/footer.php'; ?>