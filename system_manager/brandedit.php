<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?>

 <?php
  
    if(!isset($_GET["brandid"]) || $_GET["brandid"] == NULL){
        echo "<script>window.location = 'brandlist.php'; </script>";
    } else{
        //set id equal to the get method input
        $id = $_GET["brandid"]; 
    }

 ?>



    <?php 
    //instantiate the Brand object
    $brand = new Brand(); 

    //check for the post request 
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //set brandName as the post input
        $brandName = $_POST["brandName"]; 

        //call the brand object method update Brand
        $updateBrand = $brand->updateBrand($brandName, $id); 
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
                <h2>Update Brand</h2>
                <?php
                //if update 
                if(isset($updateBrand)){
                  echo $updateBrand;
                }
                    
                ?>

     

                 <?php 
                //get the specified brand based on the id submitted by the 
                //get request. getBrandById ethod will return all data from the
                //database that corrspond to the given id
                $getBrandById = $brand->getBrandById($id); 

                //if it is set, run while loop 
                if($getBrandById){

                //run while loop to get all the necessary rows to dispkay
                while($result = $getBrandById->fetch_assoc()){

                ?>
                 <form action=" " method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName"  value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php    }  }  ?>
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