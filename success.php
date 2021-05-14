<?php include 'inc/pageHeader.php'; ?>
 
 <?php 
  // $login =  Session::get("cuslogin");
  // if ($login == false) {
  // 	header("Location:login.php");
  // }

  ?>

<style>
.payment{width: 500px;min-height:200px;
text-align: center;
border: 1px solid #ddd;
margin: 0 auto; p
adding:50px; } 
.payment h2{border-bottom: 2px solid #ddd;
margin-bottom: 40px;
padding-bottom: 10px;} 
.payment p{line-height: 25px;} 
 

</style>

<div>
      <div class="payment container"> 
        <div class="row">
          <div class="col">
            <h2>Payment Successful   </h2> 
          </div> 
        </div>
        <div class="row">
          <div class="col">
            <p> Thank you for you for your purchase. We have recieved your 
                order successfully and will contact you with delivery details soon. 
                Here are your order details :
            </p>
            </div>
        </div>
        <div class="row">
          <div class = "col text-center">
            <a class="btn btn-outline-success my-2 my-sm-0" href="order.php"> Visit Here </a>
          </div>
        </div>
      </div> 
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>