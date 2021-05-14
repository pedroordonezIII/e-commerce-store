<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';  ?>
<?php include '../classes/Category.php';  ?>
<?php include '../classes/Brand.php';  ?>

<?php 
//if not set redirect to productedit page
 if (!isset($_GET['proid'])  || $_GET['proid'] == NULL ) {
     echo "<script>window.location = 'productedit.php';  </script>";
  }else {
    $id = $_GET['proid'];

  }

  //instantiate product object
   $product =  new Product();

   //check for a post request and submit post
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
        
        //update product by passing post or all the fields, file which is the image, 
        //and id for the product
        $updateProduct = $product->productUpdate($_POST, $_FILES, $id);
    }

?>
<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Products</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
				<h2>Edit Product</h2>
                <div class="table-responsive">     
				<?php 
                if (isset($updateProduct)){
                    echo $updateProduct;
                }

                ?>
                <?php 
                //get the product based on the id so it will be 
                //the product with all fields filled
                $getProduct = $product->getProById($id);
                
                //check if value is retrieved
                if($getProduct){
                //use fetch assoc for associative array
                while($value = $getProduct->fetch_assoc()){
                ?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class = "table container center table-bordered  bg-light align-middle">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                 <?php
                 //create a new category object
                    $category = new Category();
                    $getCategory =  $category->getAllCat();
                    if ($getCategory) {
                        //go through all the 
                       while ($result = $getCategory->fetch_assoc()) {
                           
                      
                 ?>
                       <option 
                      
                       <?php 
                            //compare product catId and category cat id to get correct category
                            //to display initially when editing
                           if ($value['catId'] == $result['catId']) { ?>
                              selected = "selected"
                          <?php }  ?> value="<?php echo $result['catId'];  ?>"><?php echo $result['catName']; ?></option>

                       <?php   }  } ?>
                            
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>

                <?php
                //this will be the list of all brands 
                    $brand = new Brand();
                    $getBrand =  $brand->getAllBrand();
                    if ($getBrand) {
                       while ($result = $getBrand->fetch_assoc()) {
                           
                      
                 ?> 

                       <option 
                      
                       <?php 
                        //compare the current products id to all the brand id to display
                        //current one. once it matches, have that matched one selected
                           if ($value['brandId'] == $result['brandId']) { ?>
                              selected = "selected"
                          <?php }  ?> value="<?php echo $result['brandId'];  ?>"><?php echo $result['brandName']; ?></option>
                             <?php   }  } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                    <textarea  class="form-control" type="text" width="40" rows="8" name="body">
                           <?php echo $value['body']; ?>
                    </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo  $value['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image'];?>" height="60px; width="80px;"><br/>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                          <?php
                          //check type to automatically select current type
                       if ($value['type'] == 0) { ?>
                           <option selected = "selected" value="0">Featured</option>
                            <option value="1">New</option>
                            <option value="2">General</option>
                       <?php } else if ($value['type'] == 1){  ?>

                            <option value="0">Featured</option>
                            <option selected = "selected" value="1">New</option>
                            <option value="2">General</option>
                        <?php } else{ ?>
                            <option value="0">Featured</option>
                            <option value="1">New</option>
                            <option selected="selected" value="2">General</option>
                        <?php }?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

            <?php } } ?>
               </div>
              </div>
            </div>
          </div>  
        </main>
	<script type="text/javascript">
        $(document).ready(function() {
    		$('#example').DataTable();
			} );
    </script>
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
  </body>
</html>
<?php include 'inc/footer.php';?>