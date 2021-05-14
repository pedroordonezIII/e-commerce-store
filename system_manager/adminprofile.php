<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Profile Details</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
                <div class="table-responsive card border-dark mb-3">
                <?php 
                    // if(isset($sendEmail)){
                    //     echo $sendEmail;
                    //}
                ?>
    
                <?php 
                    //get the admins session id set for the session
                    $adminId = Session::get("adminId"); 
                    //get all the admins profile data from the customers table
                    //by passing the admin id to the detadmindata function
                    $adminData = $admin->getAdminData($adminId); 

                    if(isset($adminData)){
                      //iterate through the entries
                      while($result = $adminData->fetch_assoc()){
                ?>  
                <table class="table container center table-bordered  align-middle">
                <tr>
                    <td colspan="2"> <h2>Admin Details</h2> </td>   
                </tr>
                <tr>
                    <td width="20%"> Name  </td>  
                    <td><?php echo $result["adminName"];?></td>
                </tr>
                <tr>
                     <td> Email  </td>
                    <td> <?php echo $result["adminEmail"];?> </td>
                </tr>
                <tr>
                    <td> Username </td>
                    <td><?php echo $result["adminUser"];?></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><a class="btn btn-outline-primary my-2 my-sm-0" href="updatedetails.php">Update Details</a></td>
                </tr>
                </table>
                <?php }}?>
                </div>
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
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>