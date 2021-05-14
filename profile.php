<?php
include("inc/pageheader.php"); 
?>

<style>
 .tblone{width: 550px; margin: 0 auto; border: 2px solid #ddd; } 
 .tblone tr td{text-align: justify;} 
 .icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

</style>

<?php 
 //will check the session login
  $login =  Session::get("userLogin");
  //if no session is set, redirect to the login
  //page. Profile page will not be accessible when logging out
  //but this method is better since those fields can be updated
  //and if they are updated, the session will still contain the old
  //user data
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>
<div class="container">
   <div class="row">
   <div class="col-6 table-responsive">
  <?php
  //get the current session ID set in the User class
  //login method
  $id = Session::get("userId");

  //get the data based on the ID of the user from
  //the getCustomerData method, also included all 
  //user fields in the customerLogin method in the user
  //class, so can access all data by using the session get method
  $getData = $user->getCustomerData($id); 

  //check if the data is returned
  if($getData){
     //go through the entired row based on the user
     while($userData = $getData->fetch_assoc()){
  ?>
<table class="table container center table-bordered  align-middle">
   <tr>
      <td colspan="3"> <h2> Profile Details </h2> </td>
   </tr>
   <tr>
      <td width="20%"> Name  </td>
      <td width="5%"> : </td>
      <td><?php echo $userData["name"];?></td>
   </tr>
   <tr>
      <td> Phone  </td>
      <td> : </td>
      <td><?php echo $userData["phone"];?></td>
   </tr>
   <tr>
      <td> Email  </td>
      <td> : </td>
      <td><?php echo $userData["email"];?> </td>
   </tr>
   <tr>
      <td> Address  </td>
      <td> : </td>
      <td> <?php echo $userData["address"];;?> </td>
   </tr>
   <tr>
      <td> City  </td>
      <td> : </td>
      <td><?php echo $userData["city"];;?></td>
   </tr>
   <tr>
      <td> Zipcode  </td>
      <td> : </td>
      <td><?php echo $userData["zip"];;?></td>
   </tr>
   <tr>
      <td> Country  </td>
      <td> : </td>
      <td><?php echo $userData["country"];?></td>
   </tr>
   <tr>
      <td>   </td>
      <td>  </td>
      <td>
      <a  class="btn btn-outline-success my-2 my-sm-0" href="editprofile.php">Update Details
      </td>
   </tr>
</table>
<?php } }?>
   </div>
   <div class="col-6 table-responsive">
  <?php
  $userId = Session::get("userId"); 
   
  //get payment data from the payment table by passing the user id to the getpaymentdata function
  $payment = $user->getPaymentData($userId);
  
  if($payment){

      while($userPayment = $payment->fetch_assoc()){
  ?>
<table class="table container center table-bordered  align-middle">
   <tr>
      <td colspan="3"> <h2> Payment Details </h2> </td>
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
      <td colspan="3"> <h2> Your Payment Details </h2> </td>
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