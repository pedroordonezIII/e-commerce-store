﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<main role="main" class="col-7 col-sm-8 col-lg-9 ml-sm-auto pt-3 px-4"> 
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
          align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          </div>
          <div class="container">
              <div class="row">
                <div class="col-12">
                  <?php
                    //get the current admins id. 
                     $adminId = Session::get("adminId"); 
                     //get the admin data from the admin table 
                     //by passing the admin id to the getadmindata function
                     $adminData = $admin->getAdminData($adminId); 
 
                     $result = $adminData->fetch_assoc(); 
                  ?>
                  <p>Welcome <?php echo $result["adminName"];?>. From the admin panel, you can view,
                  update, and add products, categories, and brands. In addition, you can view all customer orders, 
                  process them, and remove them by accessing the Order Menu.  There is also an Inbox Menu that allows you 
                  to view and delete all customer messages and also reply to them by email. Finally, you can view your information
                  and update your information by accessing the Admin Profile Menu.</p>
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

