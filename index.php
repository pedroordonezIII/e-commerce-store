<?php include 'inc/pageHeader.php'; ?>

<style>

</style>

<?php 
    //check if the get request for the product id is set
     if (isset($_GET['proid'])) {
        //get id from index page 
        $id = $_GET['proid'];
    
    }

    //check if the pist request method is set
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = 1;
        
        //add to the user cart and pass the quantity and id of the item to it
        $addCart = $cart->addToCart($quantity, $id);
    }   
    
    /**
     * Access the methods from the specified classes
     * from the created objects
     */
    $getCat = $category->getAllCat();
    $getBrand = $brand->getAllBrand();
    $getFpd = $product->getFeaturedProduct(); 
    $getNpd = $product->getNewProduct();
    $getStk = $product->getStackProductHome();
            	 
?>

<div class="container content_style">
    <span style="color: red; font-size: 18px;">
    <?php 
    if (isset($addCart)) {
        echo $addCart;
    }
    ?>
    </span> 
    <div class="row row-cols-2 style_margin" >
    <?php   
            if($getStk){
                while($result= $getStk->fetch_assoc()){
        ?>
        <div class="border border-success">
            <h3><?php echo $result['productName']; ?></h3>
            <a href="preview.php?proid=<?php echo $result['productId']; ?>">
		    <img src="<?php echo "system_manager/".$result['image'];?>"" class="img-fluid img-thumbnail" alt="" /></a>
		    <p>$<span class="price"><?php echo $result['price']; ?></span>
		    <form action="index.php?proid=<?php echo $result['productId']; ?>" method="post">
                <span>
                <input class="btn btn-outline-success my-2 my-sm-0"
                 type="submit" class="buysubmit" name="submit" value="Add to Cart"/>
                </span>
            </form>
        </div>
        <?php } } ?>
    </div>    
    <div class="content_top style_margin">
    	<div class="heading">
    		<h3>Featured Products</h3>
    	</div>
    </div>
	<div class="row">
        <?php 
        //if successfully get products
         if ($getFpd) {
             //fetch assoc the data to get it into an associative array
         	while ($result = $getFpd->fetch_assoc()) {
        ?>
        <div class="col-sm border border-success">
		    <a href="preview.php?proid=<?php echo $result['productId']; ?>">
		    <img src="<?php echo "system_manager/".$result['image'];?>" class="img-fluid img-thumbnail" alt="" /></a>
		    <h3><?php echo $result['productName']; ?></h3>
		    <p><?php echo $product->getFm()->textShorten($result['body'], 60); ?></p>
		    <p><span class="price">$<?php echo $result['price']; ?></span></p>
		    <div><span><a class="btn btn-outline-success my-2 my-sm-0" href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
	    </div>
        <?php }  }  ?>
	</div>
	<div class="content_bottom style_margin">
    	<div class="heading">
    	    <h3>New Products</h3>
    	</div>
    </div>
	<div class="row">
        <?php 
        if ($getNpd) {
            while ($result = $getNpd->fetch_assoc()) {
        ?>
	    <div class="col-sm border border-success">
		    <a href="preview.php?proid=<?php echo $result['productId']; ?>">
		    <img src="<?php echo "system_manager/".$result['image'];?>" class="img-fluid img-thumbnail" alt="" /></a>
		    <h3><?php echo $result['productName']; ?></h3>
            <p><?php echo $product->getFm()->textShorten($result['body'], 60); ?></p>
		    <p><span class="price">$<?php echo $result['price']; ?></span></p>
		    <div><span><a class="btn btn-outline-success my-2 my-sm-0" href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
        </div>
	    <?php  }  }  ?>
	</div>
    <div class="row table-responsive">
        <div class="col-sm">
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