<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';  ?>
<?php include '../classes/Category.php';  ?>
<?php include '../classes/Brand.php';  ?>

<?php 
    $product = new Product(); 
    
    //considition must be a post and must be submit post
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

        //call the insertProduct method with all the $_POST and $_FILES
        //for all the fields. first for posts, second for images
        $insertProduct = $product->insertProduct($_POST, $_FILES); 
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
				<h2>Add Product</h2>
                <div class="table-responsive">     
				<?php 
                //show message regarding inserted product
                if (isset($insertProduct)) {
                    echo $insertProduct;
                }
                ?>          
             <form action="" method="post" enctype="multipart/form-data">
            <table class = "table container center table-bordered  bg-light align-middle">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
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
                 //create a new category obe=ject
                   $category = new Category(); 
                //access the getALlCat method to get all categories
                   $getCategory = $category->getAllCat(); 
                   //if return
                   if($getCategory){
                       //get all rows and convert to associateve array
                       while($result = $getCategory->fetch_assoc()){
                 ?>
                       <option value="<?php echo $result['catId'];  ?>"><?php echo $result['catName']; ?></option>

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
                    $brand = new Brand();
                    $getBrand = $brand->getAllBrand();
                    if($getBrand){
                        while($result = $getBrand->fetch_assoc()){
                 ?> 

                        <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'];  ?></option>
                             <?php   }  } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea rows="8" cols="40" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
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
                            <option value="0">Featured</option>
                            <option value="1">New</option>
                            <option value="2">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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
<?php include 'inc/footer.php';?>


