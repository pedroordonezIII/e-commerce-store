<?php include 'inc/pageheader.php'; ?>

<?php 
//call the get all products method in the products 
//class to return all the products in from the products table.  
	$getAllPro = $product->getAllPro(); 
?>

<div class="main content_style">
   <div class="content">
       <div class="content_top">
           <div class="heading">
           <h3>All Products</h3>
           </div>
           <div class="clear"></div>
       </div>
         <div class="row"">

         <?php
         //if the object is returned successfully, do this
          if ($getAllPro) {
              //set the result equal to an associative array of all 
              //the items returned.  Loop through each table entry 
           while ($result = $getAllPro->fetch_assoc()) {
          
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
                       echo "Products of this category are not available";

                    }  ?> 
                
               </div>
           </div>
   </div>
</div>
</div>
    <?php include 'inc/footer.php'; ?>