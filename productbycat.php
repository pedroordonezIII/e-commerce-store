<?php include 'inc/pageheader.php'; ?>

<?php
//if the cat id is not set or null, redirect to the 404 error page
 if (!isset($_GET['catId'])  || $_GET['catId'] == NULL ) {
    echo "<script>window.location = '404.php';  </script>";
 }else {
   //otherwise, set the id equal to the cat id.
   $id = $_GET['catId'];

 }

?>




<div class="main content_style">
   <div class="content">
       <div class="content_top">
           <div class="heading">

       <?php
       $productByCat = $product->productByCat($id); 
          if ($productByCat) {
           $result = $productByCat->fetch_assoc();
         ?>

           <h3>Latest from <?php echo $result['catName']; ?> </h3>

                <?php    } ?> 

           </div>
           <div class="clear"></div>
       </div>
         <div class="row"">

         <?php
         $productByCat = $product->productByCat($id); 
          if ($productByCat) {
           while ($result = $productByCat->fetch_assoc()) {
          
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