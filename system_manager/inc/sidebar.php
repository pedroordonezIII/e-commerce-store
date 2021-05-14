<style>
    .margin {
    margin-top: 10;
    }
   
    .containerHeight{
        height: 100vh;
    }

</style>
<div class="container-fluid">
      <div class="row containerHeight">
        <nav class="col-5 col-sm-4 col-lg-3 d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                  
                <a class="nav-link active text-dark" href="dashbord.php">
                  <span data-feather="home"></span>Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item margin">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category Option
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="catadd.php">Add Category</a>
                        <a class="dropdown-item" href="catlist.php">Category List</a>
                    </div>
                </div>
              </li>
              <li class="nav-item margin">
              <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Brand Option
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="brandadd.php">Add Brand</a>
                        <a class="dropdown-item" href="brandlist.php">Brand List</a>
                    </div>
                </div>
              </li>
              <li class="nav-item margin">
              <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Product Option
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="productadd.php">Add Product</a>
                        <a class="dropdown-item" href="productlist.php">Product List</a>
                    </div>
                </div>
              </li>
            </ul>
            </div> 
        </nav> 

