<?php include 'inc/pageheader.php'; ?>

<?php
//   if (isset($_GET['proid'])) {
//     //get id from index page 
//     $id = $_GET['proid'];

// }

/**
 * check if the proid get request is set
 */
if (!isset($_GET['proid'])  || $_GET['proid'] == NULL ) {
    echo "<script>window.location = '404.php';  </script>";
 }else {
   $id = $_GET['proid'];

 }

/**
 * set variables from the category, product, and brand
 * object methods.
 */
$getCat = $category->getAllCat();
$getBrand = $brand->getAllBrand();
//access the product class object method
$getPd = $product->getSingleProduct($id); 

?>



<?php 
   /**
    * to add to th cart, check for the post request and submit post
    */
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       
    //get the quantity from the post array
        $quantity = $_POST['quantity'];
    
        //validate the quantity
        if($quantity <= 0){
            $addCart="<span class='error'>One or more products must be added!</span>";
        }else{
            //add to the cart using the quantity and product id
            $addCart = $cart->addToCart($quantity, $id);
        }
   }   

?>

<?php 
  
//    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campare'])) {
//        $productId = $_POST['productId'];     
//        $insertCom = $pd->inserCompareDate($productId, $cmrId);
//    }

?>

<?php 
//get the current userId for the user
    $userId = Session::get("userId"); 
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
    //   $saveWlist = $pd->saveWishListData($id, $cmrId);
    //access the wishList object class method to save the wish list
    //data and pass the product id and the userId for the specified user
      $saveWlist = $wishList->saveWishListData($id, $userId);
   }
?>


<style>
.mybutton{width: 100px;float: left;margin-right: 45px;}	

</style>


<div class="container content_style"> 
               <div class="cont-desc span_1_of_2">	

                <?php 
                 if ($getPd) {
                     //retrieve associative array of query
                     while ($result = $getPd->fetch_assoc()) { 
                   ?>
                   <div class="d-flex justify-content-center">
                        <div class="row">
                            <div class="col-12">
                                <h1><?php echo $result['productName'];?></h1>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-4">
                            <img src="<?php echo "system_manager/".$result['image']; ?>" class="img-fluid img-thumbnail" alt="" />
                        </div>
                        <div class="col-8">
                        <p><?php echo $product->getFm()->textShorten($result['body'], 150);?></p>
                        </div>
                   </div>
               <div class="style_margin">					
                   <div class="row">
                        <div class="col-12">
                       <p>Price: <span>$<?php echo $result['price'];?></span></p>
                       <p>Category: <span><?php echo $result['catName'];?></span></p>
                       <p>Brand:<span><?php echo $result['brandName'];?></span></p>
                       </div>
                   </div>
               <div class="row">
                    <div class="col-12">
                   <form action=" " method="post">
                       <input type="number" class="buyfield" name="quantity" value="1"/>
                       <input class="btn btn-outline-success my-2 my-sm-0" type="submit" class="buysubmit" name="submit" value="Add to Cart"/>
                   </form>	
                   </div>			
               </div>

          <?php 

            if (isset($addCart)) {
                 echo $addCart;
            }
          ?>
             <?php 

            //   if (isset($insertCom)) {
            //       echo $insertCom;
            //   }


              if (isset($saveWlist)) {
                  echo $saveWlist;
              }
                      ?>

                      
                    <?php 
                   $login =  Session::get("userLogin");
                   if ($login == true) { ?>

               <div class="row justify-content-center style_margin">
                   

                   <div class="col-4">  
                   <form action=" " method="post">
                       <input class="btn btn-outline-success my-2 my-sm-0" type="submit" class="buysubmit" name="wlist" value="Add to Wish List"/>
                   </form>	
                   </div>
               </div>    
           <?php  } ?>
           </div>
           <div class="row style_margin">
                <div class="col-12">
                    <h2>Product Details</h2>
                    <?php echo $result['body'];?>
                </div>
			</div>
       <?php } } ?>		
   </div>
   <div class="row table-responsive">
        <div class="col-auto">
            <table class="table table-bordered border-success style_margin table_style2">
                <tr>
                    <td colspan="3"> <h3>Categories</h3></td>
                </tr>
                <?php 
                    if($getCat){
                        while($result = $getCat->fetch_assoc()){
                ?>
                <tr>
                <td><a class="btn btn-outline-success my-2 my-sm-0" href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></td>
                </tr>
                <?php } }?>
            </table>
       </div>
       <div class="col-sm">
            <table class="table table-bordered border-success style_margin table_style2">
                <tr>
                    <td colspan="3"> <h3>Brands</h3></td>
                </tr>
                <?php 
                    if($getBrand){
                        while($result = $getBrand->fetch_assoc()){
                ?>
                <tr>
                <td><a class="btn btn-outline-success my-2 my-sm-0" href="productbybrand.php?brandId=<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></a></td>
                </tr>
                <?php } }?>
            </table>
        </div>
   </div>
 </div>
 </div>
<?php include 'inc/footer.php'; ?>  