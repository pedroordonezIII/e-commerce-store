<?php include 'inc/pageheader.php'; ?>
 
 <?php 
//   $login =  Session::get("cuslogin");
//   if ($login == false) {
//   	header("Location:login.php");
//   }

//   ?>

  <?php
//    if (isset($_GET['orderid']) && $_GET['orderid'] == 'order' ) {
//    $cmrId =  Session::get("cmrId");
//    $insertOrder = $ct->orderProduct($cmrId);
//    $delDate = $ct->delCustomerCart();
//   header("Location:success.php");

//    }

 ?>
 

 <div class="main">
    <div class="content">
     
    <div class="container section group">
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
        //   $getPro = $ct->getCartProduct();
        //   if ($getPro) {
        //     $i = 0;
        //     $sum = 0;
        //     $qty = 0;
        //     while ($result = $getPro->fetch_assoc()) {
        //        $i++;
        //              ?>
                <tr>
                <td><?php //echo $i;  ?></td>
                <td><?php //echo $result['productName'];  ?></td>
                
                <td>$ <?php //echo $result['price'];  ?></td>
                 <td> <?php //echo $result['quantity'];  ?></td>
                <td>
                  
                </td>
                <td>$ 
                  <?php 
                //   $total = $result['price'] * $result['quantity'];
                //   echo $total;

                  ?>      
 
                </td>
               
              </tr>
              <?php 
                //   $qty = $qty +  $result['quantity'];
                // $sum = $sum + $total;
               ?>


              <?php //} }   ?>
               
              
            </table>
        </div>          
        
        <div class="row">
        <div class="table-responsive col-sm">
            <table class = "table table-bordered border-success">
              <tr>
                <th>Sub Total : </th>
                <td>$ <?php //echo $sum;  ?></td>
              </tr>
              <tr>
                <th>VAT : </th>
                <td>   
                   10% (<?php //echo $vat = $sum * 0.1; ?> )
                </td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>$<?php 
                //   $vat = $sum * 0.1;
                //   $gtotal = $sum + $vat;
                //   echo $gtotal;
                  ?> </td>
              </tr>


                 <tr>
                <th>Quantity :</th>
                <td> <?php //echo $qty; ?></td>
              </tr>
             </table>
        </div>

        <div class="col-sm">  
        <?php 
        //    $id = Session::get('cmrId');
        //    $getdata = $cmr->getCustomerData($id);
        //    if ($getdata) {
        //      while ($result = $getdata->fetch_assoc()) {     
        ?>
            <table class="table table-bordered border-success">
                <tr>
                    <td colspan="3"> <h3>Profile Details</h3></td>
                </tr>
                <tr>
                    <td width="20%"> Name  </td>
                    <td width="5%"> : </td>
                    <td> <?php //echo $result['name']; ?>  </td>
                 </tr>
                <tr>
                    <td> Phone  </td>
                    <td> : </td>
                    <td> <?php //echo $result['phone']; ?> </td>
                </tr>
                <tr>
                     <td> Email  </td>
                    <td> : </td>
                    <td> <?php //echo $result['email']; ?>  </td>
                </tr>
                <tr>
                    <td> Address  </td>
                    <td> : </td>
                    <td> <?php //echo $result['address']; ?>  </td>
                </tr>
                <tr>
                    <td> City  </td>
                    <td> : </td>
                    <td><?php //echo $result['city']; ?>  </td>
                </tr>
                <tr>
                    <td> Zipcode  </td>
                    <td> : </td>
                    <td> <?php //echo $result['zip']; ?>  </td>
                </tr>
                <tr>
                    <td> Country  </td>
                    <td> : </td>
                    <td> <?php //echo $result['country']; ?>  </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>  </td>
                    <td><a class="btn btn-outline-success my-2 my-sm-0" href="editprofile.php"> Update Details </a> </td>
                </tr>
            </table>
        <?php   //} }  ?> 
        </div>
        </div>
        <div class="back"> 
               <a class="btn btn-outline-success my-2 my-sm-0" href="?orderid=order"> Order </a>
          </div>
    </div>
 </div>

</div>
</div>
<?php include 'inc/footer.php'; ?>