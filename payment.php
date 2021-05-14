<?php include 'inc/pageheader.php'; ?>
 
 <?php 
  $login =  Session::get("userLogin");
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>

 <div>
    <div>
      <div>
      
      <div class="payment"> 
      <h2> Choose Payment Option </h2>  
      <a  class="btn btn-outline-success my-2 my-sm-0" href="offline.php"> Continue to payment </a>
      </div>
   <div class="back">
    <a class="btn btn-outline-success my-2 my-sm-0" href="cart.php">Go Back </a>
   </div>
    </div>
 </div>
</div>
</div>
   
<?php include 'inc/footer.php'; ?>