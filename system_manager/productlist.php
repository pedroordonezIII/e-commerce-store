<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';  ?>
<?php include_once '../helpers/Format.php';?>

<?php
//instantiate product and format objects
$product = new Product();
$format  = new Format();

?>


<?php
//check if the delpro get rquest is set
 if (isset($_GET['delpro'])) {
	 $id = $_GET['delpro'];
	 //delete the product by the current id by passsing the product id
	 //to this function.
	 $delpro = $product->deleteProById($id);

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
				<h2>Product List</h2>
                <div class="table-responsive">     
				<?php	
		//display the message 
         if (isset($delpro)) {
         	echo  $delpro;
         }
          ?>


            <table class="table table-striped" id="example">
			<thead>
				<tr>
					<th>Post Title</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
           <?php 
           $getProduct = $product->getAllPro();
           if ($getProduct) {
			//post title number
           	$i = 0;
			//fetch assoc array for all table items
          	while ($result = $getProduct->fetch_assoc() ) {
          	$i++;//increment
           ?>


				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $format->textShorten($result['productName'], 15);?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
				    <td><?php echo $format->textShorten($result['body'], 30);?></td>
					<td><?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="40px; width="60px;"></td>
					<td><?php 
					//check type to display
					if ($result['type'] == 0) {
						echo "Featured";
					}else if($result['type'] == 1) {
						echo "New";
					} else{
						echo "General";
					}

					?></td>
					<td><a class="btn btn-outline-primary my-2 my-sm-0" href="productedit.php?proid=<?php echo $result['productId']; ?>">Edit</a> 
								|| <a class="btn btn-outline-primary my-2 my-sm-0" onclick="return confirm('Are you sure to delete')"
								 href="?delpro=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
				 <?php  }  } ?>
				
				 
			</tbody>
		</table>
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