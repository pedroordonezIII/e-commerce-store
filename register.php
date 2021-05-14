<?php include 'inc/pageHeader.php'; ?>

<?php 

//since session will be set upon logging in, use
//the get method to retrieve the user login already set
//which will check if a session is set and if not, it will return false
$login = Session::get("userLogin"); 

//if it is true, redirect to order.php and the login will
//not be accessible to users upon logging in
if($login == true){
  //redirect to the order.php
  header("Location:order.php"); 
}

?>


<?php 
 
 //check for the post request register
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) ) {
            
    //will take the whole post method for all the fields
    //post will contain all fields
      $customerReg = $user->customerRegistration($_POST);
  }

?>

<div class="container">
  <div class="content">
              <?php 
              //make message visible to customer isomg customerReg
                if (isset($customerReg)) {
                    echo $customerReg;
                }
              ?>
          <h3>Register New Account</h3>
        <form class="row g-3" action=" " method="post">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" placeholder="Name" />
            </div>
            <div class="col-md-6">
                 <label class="form-label">Address</label>
                 <input class="form-control" type="text" name="address" 
                 placeholder="Address" />
            </div>
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input class="form-control" type="text" name="city" placeholder="City" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Country</label>
                <input class="form-control" type="text" name="country" placeholder="Country" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Zip</label>
                <input class="form-control" type="text" name="zip" placeholder="Zip" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input class="form-control" type="text" name="phone" placeholder="Phone" />
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" type="text" name="email"
                placeholder="Email" />
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input class="form-control" type="text" name="pass" placeholder="password" />
            </div>
         <div class="col-12">
            <div>
                <button type="submit" name="register" 
                class="btn btn-outline-success my-2 my-sm-0">Create Account</button>
            </div>
         </div>
        </form>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>