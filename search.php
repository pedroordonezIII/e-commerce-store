<?php include 'inc/pageheader.php'; ?>

<?php
//check if the search get request is set and if it not, send to the 404 page
 if (!isset($_GET['search'])  || $_GET['search'] == NULL ) {
    echo "<script>window.location = '404.php';  </script>";
 }else {
   //set the search variable to the search value
   $search = $_GET['search'];

 }

?>




<div class="main content_style">
   <div class="content">
       <div class="content_top">
           <div class="heading">


           </div>
           <div class="clear"></div>
       </div>
         <div class="row"">

         <?php
         //retrieve the products matching the corresponding search 
         //by accessing the productBySearch function
         $productBySearch = $product->productBySearch($search); 
          if ($productBySearch) {
            //iterate through all the result rows 
           while ($result = $productBySearch->fetch_assoc()) {
          
         ?>
               <div class="col-sm border border-success">
                   <a href="preview.php?proid=<?php echo $result['productId']; ?>">
                        <img src="<?php echo "system_manager/".$result['image']; ?>" class="img-fluid img-thumbnail" alt="" /></a>
                   <h2><?php echo $result['productName']; ?> </h2>
                     <p><span class="price">$<?php echo $result['price']; ?></span></p>
                    <div class="button"><span><a class="btn btn-outline-success my-2 my-sm-0" href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
               </div>
                <?php  } } else { ?>
                       <p>Products for this search are not available.</p>
               <?php } ?>
                
               </div>
           </div>

   
   
   </div>
</div>
</div>
  <?php include 'inc/footer.php'; ?>