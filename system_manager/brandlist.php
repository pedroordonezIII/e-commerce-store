<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?>

<?php
	//instantiate brand object
	$brand = new Brand();

	//check if the delbrand get request is set
	if(isset($_GET['delbrand'])){

		//set the brand id to the delbrand get request
		$brandId = $_GET["delbrand"]; 

		//access the delete brand by id method and pass the brand 
		//id to delete the brand
		$deleteBrand = $brand->deleteBrandById($brandId); 
	} 

?>
<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Brands</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
				<h2>Brand List</h2>
                <div class="table-responsive">     
				<?php
				if(isset($deleteBrand)){
				echo $deleteBrand;
				}
          		?>
                    <table class="table table-striped" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
              		<?php
			  		//get all the brands in an object
             		$getBrands = $brand->getAllBrand();
			 		if($getBrands){
					//serial number
				 	$i=0;
				 	//fetch the brand in an associative array
				 	while($result = $getBrands->fetch_assoc()){
				 	$i++; 
              		?>
					<tr class="odd gradeX">
							<td><?php  echo $i; ?></td>
							<td><?php echo $result["brandName"]; ?></td>
							<td><a class="btn btn-outline-primary my-2 my-sm-0" href="brandedit.php?brandid=<?php echo $result["brandId"]; ?>">Edit</a> 
								|| <a class="btn btn-outline-primary my-2 my-sm-0" onclick="return confirm('Are you sure to delete')" 
								href="?delbrand=<?php echo $result["brandId"]; ?>">Delete</a></td>
						</tr>

						<?php 	} }  ?>
						 
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


