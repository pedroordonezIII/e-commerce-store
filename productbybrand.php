<?php include 'inc/pageheader.php'; ?>

<?php
//check if the brand id is not set to redirect to the 404 error page
 if (!isset($_GET['brandId'])  || $_GET['brandId'] == NULL ) {
    echo "<script>window.location = '404.php';  </script>";
 }else {
   //otherwise retrieve that brandid and set to id
   $id = $_GET['brandId'];

 }

?>




<div class="main content_style">
   <div class="content">
       <div class="content_top">
           <div class="heading">

       <?php
       //pass the product id to the product by rand table to retrieve all the 
       //items with the specified brand
       $productByBrand = $product->productByBrand($id); 
          if ($productByBrand) {
            //fetch assoc on returned query object to make it into an associative array
           $result = $productByBrand->fetch_assoc();
         ?>

           <h3>Latest from <?php echo $result['brandName']; ?> </h3>

                <?php    } ?> 

           </div>
       </div>
         <div class="row"">

         <?php
         $productByBrand = $product->productByBrand($id); 
          if ($productByBrand) {
           while ($result = $productByBrand->fetch_assoc()) {
          
         ?>
               <div class="col-sm border border-success">
                   <a href="preview.php?proid=<?php echo $result['productId']; ?>">
                        <img src="<?php echo "system_manager/".$result['image']; ?>" class="img-fluid img-thumbnail" alt="" /></a>
                   <h2><?php echo $result['productName']; ?> </h2>
                     <p><span class="price">$<?php echo $result['price']; ?></span></p>
                    <div class="button"><span><a class="btn btn-outline-success my-2 my-sm-0" href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
               </div>
                <?php  } } else {
                    header("Location:404.php");
                       echo "Products of this brand are not available";

                    }  ?> 
                
               </div>
           </div>

   
   
   </div>
</div>
</div>
  <?php include 'inc/footer.php'; ?>