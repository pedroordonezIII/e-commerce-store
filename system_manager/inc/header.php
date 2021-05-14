<?php 
ob_start();
include_once '../lib/Session.php';
//check the session at the start
Session::checkSession();

include '../classes/Contact.php';
include '../classes/Admin.php';
include_once '../helpers/Format.php';
include_once '../classes/Order.php';
?>

<?php
//instantiate all class objects to make them accessable
$contact = new Contact(); 
$order = new Order();
$format = new Format();
$admin = new Admin();

//get all the message, order, and order history count
$messageCount = $contact->countMessages();
$orderCount = $order->countOrders();
$historyCount = $order->countHistory();
?>
<?php
//   header("Cache-Control: no-cache, must-revalidate");
//   header("Pragma: no-cache"); 
//   header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
//   header("Cache-Control: max-age=2592000");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" 
    rel="stylesheet">

    <title>Supplement Powerhouse Administrator</title>

    <!-- Bootstrap core CSS -->
    <link 
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
    crossorigin="anonymous">
      <!-- BEGIN: load jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
    crossorigin="anonymous"></script>
    <scirpt src="jquery.table-shrinker.js"></scirpt>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row bg-dark text-light border border-white">
        <div class="col-6 col-md-8">
          <h1>Supplement Powerhouse</h1>
					<p>Administrator</p>
        </div>
          <div class="col-6 col-md-4">
              <div class="">
                <ul class="list-group list-group-horizontal-sm">
                <img class="list-group-item list-group-item-dark img-fluid img-thumbnail" src="img/img-profile.jpg" alt="Profile Pic" />
                <?php
                     $adminId = Session::get("adminId"); 
                     $adminData = $admin->getAdminData($adminId); 
 
                     $result = $adminData->fetch_assoc(); 
                  ?>
                  <li class=" list-group-item list-group-item-dark nav-item nav-link">Hello <?php echo $result["adminName"];?></li>
                  <?php
                    //check the get method when pressing logout and have the session destroyed
                    if(isset($_GET['action']) && $_GET['action'] == "logout"){
                        //destroy the session so when the page can be redirected 
                        //to the login page
                        Session::destroy(); 
                    }
                    ?>
                  <a href="?action=logout" class=" list-group-item list-group-item-dark nav-item nav-link">Sign Out</a>
                </ul>
              </div>
          </div>
      </div>
      </div>
    <div>
        <nav class="navbar sticky-top navbar-expand-lg justify-content-between navbar-dark bg-dark">
            <a class="navbar-brand" href="dashbord.php">Administrator</a>
             <button class="navbar-toggler" data-toggle="collapse" data-target="#expandme">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="expandme">
                <div class="navbar-nav">
                     <a href="dashbord.php" class="nav-item nav-link"> <span data-feather="home"></span>Dashboard<span class="sr-only">(current)</span></a>
                     <a href="adminprofile.php" class="nav-item nav-link">Admin Profile</a>
                    <a href="inbox.php" class="nav-item nav-link">Inbox <span class="badge badge-light"> <?php echo $messageCount?></span>
                    <span class="sr-only">unread messages</span>
                    </a>
                    <a href="mainorder.php" class="nav-item nav-link">Order <span class="badge badge-light"><?php echo $orderCount?></span>
                    <span class="sr-only">current orders</span>
                    <a href="orderhistory.php" class="nav-item nav-link">Order History <span class="badge badge-light"><?php echo $historyCount?></span>
                    <span class="sr-only">order history</span>
                  </a>
                 </div>
            </div>
        </nav>
    </div>