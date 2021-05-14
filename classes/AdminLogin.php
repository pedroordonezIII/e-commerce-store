<?php
//include all files 
include '../lib/Session.php';
Session::checkLogin();//check login
include_once '../lib/Database.php';
include_once '../helpers/Format.php';
?>

<?php

/**
 * The AdminLogin class will allow the user to login 
 * to the system and allow the user input to be processed 
 * and validated by comparing the user form input to 
 * those already in the database to correctly login.  
 */
class AdminLogin{

    //initialize the class attributes
    private $db; 
    private $fm; 


    /**
     * Initialize the constructor, which will 
     * be called upon instantiating objects of the
     * class.  
     */
    public function __construct(){
        //create objects of the class for the attributes.  
        //these objects correspond to properties
        $this->db = new Database(); 
        //new format object
        $this->fm = new Format();

    }

    /**
     * admin login class that takes the admin username as 
     * input and admin password as input
     * Will first validate the inputs using 
     * validation function in format class
     * Will then remove special characters from
     * the input. It will then check for emptiness
     * and if empty, will return error result and make 
     * adminlogin false
     * if not empty, function will perform a query on the database
     * and compare the user input with the database values
     * Will then use the select query from the database class
     * which will either return a reference to the object 
     * or false. If everything is correct, it will not be false
     * and all session items will be added and the user will be redirected
     * to correct location
     */
    public function adminLogin($adminUser, $adminPass){
        //validate the admin username using validation method
        $adminUser = $this->fm->validation($adminUser); 
        //validate the admin password class using validation method
        $adminPass = $this->fm->validation($adminPass); 

        /*
        using the built in function that 
        takes the database connection and the 
        string to be escaped or database field
        to escape any special characters
        */
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser); 
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
    
        //validate for emptiness
        if(empty($adminUser) || empty($adminPass)){
            //message to show if it is empty
            $loginmsg = "Username or Password fields must not be empty";
            //set admin login to false
            Session::set("adminlogin", false); 
            //return the login message variable if an error occurred
            return $loginmsg; 
        } else{
            //if it is not empty, perform query
            //query will compare user input to 
            //data inside the database and 
            //redirect the user to the correct
            //page depending on input
            $query = "SELECT * FROM tbl_admin
                    WHERE adminUser='$adminUser'
                    AND adminPass='$adminPass'";
            /*
            accesss the select method with the 
            db object db and pass the query 
            to the select method and set it 
            equal to result.
            */
            $result = $this->db->select($query); 

            //if it is not false and return value is true and 
            //successful login information is provided, do this
            if($result != false){
                //fetch associative array of rows from the database using fetch_assoc() built in function
                $value = $result->fetch_assoc(); 
                //set al values to corresponding results
                /*
                if correct login information, then redirect
                to the admin home page and set all the session
                value corresponding to the admin user
                */
                Session::set("adminlogin", true); 
                //set admin id to corresponding value
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                Session::set("adminEmail", $value['adminEmail']);  
                //redirect to the admin homepage
               //check the session and rediret user
                header("Location:dashbord.php");
            }else{
                //show message 
                $loginmsg = "The username or password are incorrect"; 
                //set admin login to false
                Session::set("adminlogin", false); 
                //Session::checkLogin();
                return $loginmsg; 
            }
        }
    }

}

?>