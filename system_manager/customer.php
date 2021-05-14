<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/User.php');
//instantiate user class
$user = new User();
?>

<?php
//check if the user id is not set or null and if it is not, redirect to the 
//main order page.
if(!isset($_GET["userId"]) && $_GET["userId"] == NULL){
    echo "<script>window.location = 'mainorder.php';</script>";
} else{
    //set the user id to the get request user id
    $userId = $_GET["userId"];
}

?>


<?php
//if post request and submit post is set, redirect to the main orders page
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
    echo "<script>window.location = 'mainorder.php';</script>";
}
?>


<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Customer Details</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-6">
                <div class="table-responsive card border-dark mb-3">
                <?php
                $userData = $user->getCustomerData($userId); 

                if($userData){

                    while($result = $userData->fetch_assoc()){
                ?>
                <form action=" " method="post">
                    <table class="table container center table-bordered  align-middle">	
                    <tr>
                    <td colspan="3"> <h2> Customer Details </h2> </td>
                    </tr>				
                        <tr>
                            <td> Customer Name </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["name"]; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td> Customer Address </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["address"];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                             <td> Customer City </td>
                             <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["city"]; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                             <td> Customer Country </td>
                             <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["country"];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td> Customer Zip </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["zip"]; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                             <td> Customer Phone </td>
                             <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["phone"]; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td> Customer Email </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result["email"]; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                            </td>
                            <td>
                                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Continue" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }}?>
                </div>
              </div>
              <div class="col-6">
                <div class="table-responsive card border-dark mb-3">
                <?php
                $userpayment = $user->getPaymentData($userId);
  
                if($userpayment){
              
                    while($userPayment = $userpayment->fetch_assoc()){
                ?>
                <form action=" " method="post">
                    <table class="table container center table-bordered  align-middle">	
                    <tr>
                    <td colspan="3"> <h2> Payment Details </h2> </td>
                    </tr>				
                        <tr>
                            <td> Name on Card </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $userPayment["cardname"]; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td> Card Number </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $userPayment["cardnumber"];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                             <td> Exp Month </td>
                             <td>
                                <input type="text" readonly="readonly" value="<?php echo $userPayment["expmonth"]; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                             <td> Exp Year </td>
                             <td>
                                <input type="text" readonly="readonly" value="<?php echo $userPayment["expyear"];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td> CVV </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $userPayment["cvv"]; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                            </td>
                            <td>
                                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Continue" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }}?>
                </div>
              </div>
            </div>
          </div>  
        </main>
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
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


