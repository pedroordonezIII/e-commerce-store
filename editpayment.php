<?php include 'inc/pageHeader.php'; ?>

<style>
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


<?php 
 
 //check for the post request register
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment']) ) {

    //get the session id by accessing the static session class
    //get method to get the user id
    $userId = Session::get("userId"); 
            
    //will take the whole post method for all the fields
    //post will contain all fields
    $customerPayment = $user->customerPayment($userId, $_POST);
  }

?>

<div class="container">
  <div class="content">
              <?php 
              //make message visible to customer isomg customerReg
                if (isset($customerPayment)) {
                    echo $customerPayment;
                }
              ?>
        <h3>Payment</h3>
        <label for="fname">Accepted Cards</label>
        <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
        </div>
        <?php
        //get the user id
  $userId = Session::get("userId"); 

  //get the user payment details based on the id from the user object class
  $payment = $user->getPaymentData($userId);
  
  //check if payment is returned
  if($payment){

    //iterate through the payment fields
      while($userPayment = $payment->fetch_assoc()){
  ?>
        <form class="row g-3" action=" " method="post">
            <div class="col-md-6">
                <label class="form-label">Name on Card</label>
                <input class="form-control" type="text" name="cardname" value="<?php echo $userPayment["cardname"];?>" />
            </div>
            <div class="col-md-6">
                 <label class="form-label">Credit card number</label>
                 <input class="form-control" type="text" name="cardnumber" 
                 value="<?php echo $userPayment["cardnumber"];?>" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Exp Month</label>
                <input class="form-control" type="text" name="expmonth" value="<?php echo $userPayment["expmonth"];?>" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Exp Year</label>
                <input class="form-control" type="text" name="expyear" value="<?php echo $userPayment["expyear"];?>" />
            </div>
            <div class="col-md-6">
                <label class="form-label">CVV</label>
                <input class="form-control" type="text" name="cvv" value="<?php echo $userPayment["cvv"];?>" />
            </div>
         <div class="col-12">
            <div>
                <button type="submit" name="payment" 
                class="btn btn-outline-success my-2 my-sm-0">Save Payment</button>
            </div>
         </div>
        </form>
        <?php }} else {?>
            <form class="row g-3" action=" " method="post">
            <div class="col-md-6">
                <label class="form-label">Name on Card</label>
                <input class="form-control" type="text" name="cardname" placeholder="Name on Card" />
            </div>
            <div class="col-md-6">
                 <label class="form-label">Credit card number</label>
                 <input class="form-control" type="text" name="cardnumber" 
                 placeholder="Card Number" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Exp Month</label>
                <input class="form-control" type="text" name="expmonth" placeholder="Exp Month" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Exp Year</label>
                <input class="form-control" type="text" name="expyear" placeholder="Exp Year" />
            </div>
            <div class="col-md-6">
                <label class="form-label">CVV</label>
                <input class="form-control" type="text" name="cvv" placeholder="CVV" />
            </div>
         <div class="col-12">
            <div>
                <button type="submit" name="payment" 
                class="btn btn-outline-success my-2 my-sm-0">Save Payment</button>
            </div>
         </div>
        </form>
        <?php }?>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>