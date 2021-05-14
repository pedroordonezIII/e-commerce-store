<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';  ?>

<?php
	
	//create category object
	$category = new Category(); 

	//check for the get delete method
	if(isset($_GET["delcat"])){
		//will make what is submitted with get request 
		//equal to id which is the category id
		$id = $_GET["delcat"]; 

		//call the deleteCatId method to delete the 
		//category by passing the id
		$deleteCat = $category->deleteCatById($id);
	}

?>

<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Categories</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
				<h2>Category List</h2>
                <div class="table-responsive">     
					<?php

					if(isset($deleteMessage)){
						echo $deleteMessage;
					}
					?>   
                    <table id="example" class="table table-striped">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
              <?php
				//iterate from here and call the get all cat method to return 
				//all rows of the category table
				$getCat = $category->getAllCat(); 
				//check if data is present
				if($getCat){
					$i=0; //serial number
					//perform a while loop and set result equal to 
					//the associative array returned by fetch_assoc on
					//the getCat object
					while($result = $getCat->fetch_assoc()){
					$i++; //auto increment
              ?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result["catName"]; ?></td>
							<td><a class="btn btn-outline-primary my-2 my-sm-0" href="catedit.php?catid=<?php echo $result["catId"]; ?>">Edit</a> 
								|| <a class="btn btn-outline-primary my-2 my-sm-0" onclick="return confirm('Are you sure you want to delete')" 
								href="?delcat=<?php echo $result["catId"];?>">Delete</a></td>
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
