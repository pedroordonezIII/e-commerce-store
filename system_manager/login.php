<?php include '../classes/AdminLogin.php';  ?>

  <?php
  //create an object for the class 
  $adminLogin = new AdminLogin();
  //check if there is a post method request
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//get the post request fields adminUser 
    $adminUser = $_POST['adminUser'];
	//get the post request for the adminPass field
	//make md5 to convert to the encrypted password
    $adminPass = md5($_POST['adminPass']);

	//now check the login credentials by calling the adminLogin method
	//from the object
	$checkLogin = $adminLogin->adminLogin($adminUser, $adminPass);

    }

  ?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 	integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
 	crossorigin="anonymous"/>  
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script> 
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
	integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
	integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
	crossorigin="anonymous"></script>
	</head>
<body class="p-3 mb-2 bg-dark">
<div class="conainer p-3 mb-2 bg-light text-dark" id="container">
<div class="row">
	<div class="col align-self-center">
	<form action="" method="post">
		<h1 class="text-center">Admin Login</h1>
		<span style="color:red; font-size: 18px;"> 

   		<?php 
   		//will only return the loginmsg if an error occurs
    		if(isset($checkLogin)){
			//echo the login checl
			echo $checkLogin; 
			}
		?>
		</span>
  		<div class="form-group">
    		<label for="adminUser">Username</label>
			<input class="form-control" type="text" placeholder="Username" name="adminUser"/>
  		</div>
  		<div class="form-group">
    		<label for="adminPass">Password</label>
			<input class="form-control" type="password" placeholder="Password" name="adminPass"/>
  		</div>
  		<button type="submit" class="btn btn-dark">Login</button>
	</form>
	</div>
	</div>
</div><!-- container -->
</body>
</html>
