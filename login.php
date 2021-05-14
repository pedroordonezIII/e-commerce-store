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
 
 //check for login post method
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
      
    //call the customerLogin mehtod in the User class object and mass the post method 
    //to it which contains an array of posts
      $customerLogin = $user->customerLogin($_POST);
  }

?>


<div class="container">
  <div class="content">


              <?php 
              //show message when users cannot login
                if (isset($customerLogin)) {
                    echo $customerLogin;
                }

              ?>

          <h3>Existing Customers</h3>
          <p>Sign in with the form below.</p>
          <form class="row g-3" action=" " method="post">
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" placeholder="Email" type="text">
            </div>
            <div class="col-md-6">
                 <label class="form-label">Password</label>
                 <input class="form-control" name="pass" placeholder="Password" type="password" >
            </div>
            <div class="col-12">
            <div>
                <button type="submit" name="login"
                class="btn btn-outline-success my-2 my-sm-0">Sign In</button>
            </div>
         </div>
        </form>
  </div>
</div>
</div>
  <?php include 'inc/footer.php'; ?>  