<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';  ?>

 <?php
    //check if id is not set or null and redirect to page
    if(!isset($_GET["catid"]) || $_GET["catid"] == NULL){
        //if not set, redirect to catlist page
        echo "<script>window.location = 'catlist.php';</script>"; 
    } else{
        //set the id variable to the get method on getid variable
        $id = $_GET["catid"]; 
    }

 ?>



<?php 
//inititiate category object
   $category =  new Category();
   //check for post method
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        
        //update the category using the catUpdate function
        //pass the catName and the id for the category
        $updateCat = $category->updateCat($catName, $id);
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
                <h2>Update Category</h2>
                <?php
                    //display the message to the user
                    if (isset($updateCat)) {
                        echo $updateCat;
                    }
              ?>

                <?php
                //will set the getCat variable to the returned
                //object from the query
                $getCat = $category->getCatById($id); 
                if($getCat){
                    //make it into an associative array
                    while($result = $getCat->fetch_assoc()){
                ?>

                 <form action=" " method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName"  value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }  }  ?>
              </div>
            </div>
          </div>  
        </main>
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