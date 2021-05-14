<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';  ?>

<?php 

    //instantiate the new brand object
    $brand = new Brand();

    //check for a post request
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //let the brand Name equal the brandName post
        $brandName = $_POST["brandName"];

        //call the insertBrand Function and pass the post value
        $insertBrand = $brand->insertBrand($brandName); 
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
                <h2>Add New Brand</h2>
                <?php
                //check if insertBrand is instantiated
                    if(isset($insertBrand)){
                        echo $insertBrand; 
                    }
              ?>
            



                 <form action=" " method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
              </div>
            </div>
          </div>  
        </main>
      </div>
    </div>

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