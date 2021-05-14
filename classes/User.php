<?php
//The include once built in function will be used
//to include the database and format files 
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>

<?php

/**
 * The user class will implement several functions 
 * related to the user. The implementation in this class
 * will allow customers to register, login, retrieve customer 
 * information, update customer information, input customer 
 * payment, and will allow the customer to retrieve that payment
 * information.  
 */

class User{

    /**
     * private attributes for the class such 
     * as the database and format attributes
     */
    private $db; 
    private $fm; 

    /**
     * The constructor will be called upon instantiating 
     * a user object.  
     */
    public function __construct(){
        //create objects of the class
        //these objects correspond to properties
        $this->db = new Database(); 
        //new format object that will set the fm attribute in the 
        //class
        $this->fm = new Format();

    }

    /**
     * This method gets user data from a form 
     * post request and inserts the data into 
     * the database table called customers. If 
     * any of the fields are left empty, an error
     * message will be returned.  Otherwise, the 
     * email input from the form will be used to 
     * check if the email is already in the system  
     * If the email is in the system, an error 
     * message will be returned telling the user
     * that the email is already in the system.  
     * Otherwise, the data will be inserted into 
     * the customers table in the database.  
     */
    public function customerRegistration($data){

        //validation data, and make each field as the database field based on post
        //use this built in function to escape all special characters
        //access fields by using array since post is array of fields
        $name       = mysqli_real_escape_string($this->db->link, $data["name"]);
        $city       = mysqli_real_escape_string($this->db->link, $data["city"]);
        $address    = mysqli_real_escape_string($this->db->link, $data["address"]);
        $country    = mysqli_real_escape_string($this->db->link, $data["country"]);
        $zip        = mysqli_real_escape_string($this->db->link, $data["zip"]);
        $email      = mysqli_real_escape_string($this->db->link, $data["email"]);
        //use the md5 hash to hash the password input
        $pass       = mysqli_real_escape_string($this->db->link, md5($data["pass"]));
        $phone      = mysqli_real_escape_string($this->db->link, $data["phone"]);
        
         //check if any of the fields are empty and return error
         if($name == "" || $city== "" || $address == "" ||
         $country == "" || $zip == "" || $email == "" || 
         $pass == "" || $phone == ""){
            $msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg; 
         }
         //select the email to see if the email exists 
         //in the database already. check if one email 
         //is already present. Only look for one instance
         $emailQuery = "SELECT * FROM tbl_customer
                    WHERE email='$email' 
                    LIMIT 1";
        
        //select query, if not returned it is false
        $emailCheck = $this->db->select($emailQuery); 

        //check if something is returned
        //if something is returned, email is already
        //used
        if($emailCheck != false){
            //show this message if email exists
            $msg = "<span class='error'>Email already exists.</span>";
            return $msg; 
        }
        else{
            //insert the data into the database tbl_customer
             //insert all the field names and then all the values
             $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) 
          VALUES ('$name','$address','$city','$country','$zip','$phone','$email','$pass')";  
 
          //call the insert in the database object class and pass the query to it.   
          $inserted_row = $this->db->insert($query);

          //check if inserted_row is inserted successufully
          if ($inserted_row) {
    			$msg = "<span class='success'>Customer Registered Successfully.</span> ";
    			return $msg;// Return a success message to the user if inserted successfully
    		}else {
    			$msg = "<span class='error'>Customer Data Not Inserted .</span> ";
    			return $msg; // Return error message 
            }
        }
        
    }

    /**
     * This method will take a post method
     * as input and will return an error message
     * if the user leaves the input data blank
     * or if the email or password do not match one
     * in the database.  If all is correct, based 
     * on the database query that compares the input
     * password and email to those in the database, 
     * a session is created and the session values are
     * set based on the returned user data from the select 
     * method on the customers table in the database.  
     * The page is then redirected to the cart page upon
     * successful login.  
     */

    public function customerLogin($data){

        //validate the password and email input fields 
        $pass        =  mysqli_real_escape_string($this->db->link, md5($data['pass']));
        $email       = mysqli_real_escape_string($this->db->link, $data["email"]); 

        //if any field is ;eft empty, return an error message
        if ($email == ""  || $pass == "" ) {
            $msg = "<span class='error'>Fields must not be empty .</span>";
            return $msg; // return message 
        } else{

            //query the database to check if the email and password are present
            //in the system to login using the select query where the email 
            //and password match those in the database table.  
            $query = "SELECT * FROM tbl_customer WHERE email='$email'
                    AND pass='$pass'"; 

            //access the select method in the database object db that contains
            //the select method and pass the query to it
            $result = $this->db->select($query); 

            //check if the result is true
            if($result != false){

                //make the returned result into an associative array using the fetch_assoc() built in
                //function
                $value = $result->fetch_assoc(); 

                //set the userlogin to true using the set method in the session class
                Session::set("userLogin", true); 

                //add all user information in the session by setting user data based on the returned
                //database information that is an associative array in the value variable using the 
                //set method in Session class for all user information
                Session::set("userId", $value["id"]);
                Session::set("userEmail", $value["email"]); 
                Session::set("userName", $value["name"]); 
                Session::set("userAddress", $value["address"]); 
                Session::set("userCity", $value["city"]); 
                Session::set("userCountry", $value["country"]); 
                Session::set("userZip", $value["zip"]);
                Session::set("userPhone", $value["phone"]);

                //redirect to a specfic page using the header function upon logging int
                header("Location: cart.php");
            } else{
                //if the email or password do not match, return an error message
                $msg = "<span class='error'>Email or password are incorrect.</span> ";
                return $msg; // return message 
            }
        }

    }


    /**
     * This function takes an id as input, 
     * which is the user id for the user, 
     * and uses that id to select a specified 
     * row from the customer table that matches 
     * that ID. This method then returns the 
     * specified row that matches the input id
     * in the customer <table class=""></table>
     */
    public function getCustomerData($id){

        //query the customer table based on the 
        //input id from the session which will
        //return a row based on the id
        $query = "SELECT * FROM tbl_customer
                WHERE id='$id'"; 
        
        //pass the query to the select method in db class object
        $result = $this->db->select($query); 

        return $result; 

    }

    /**
     * 
     * This method takes a POST data request array 
     * as input and a user ID as input and performs an
     * update query on the database based on the data inputed
     * through the form.  The data is then updated based on
     * the user ID of the current users session.
     * @return: the return value will be a message 
     * showing a success or error message for the user
     */
    public function updateCustomerData($data, $id){

        //validation using the validation method in the fm object class
        $name       = $this->fm->validation($data["name"]);
        $phone      = $this->fm->validation($data["phone"]); 
        $email      = $this->fm->validation($data["email"]); 
        $address    = $this->fm->validation($data["address"]); 
        $city       = $this->fm->validation($data["city"]); 
        $zip        = $this->fm->validation($data["zip"]); 
        $country    = $this->fm->validation($data["country"]); 

        //validation data, and make each field as the database field based on post
        //use this built in function to escape all special characters
        //access fields by using array since post is array of fields
        $name       = mysqli_real_escape_string($this->db->link, $name);
        $city       = mysqli_real_escape_string($this->db->link, $city);
        $address    = mysqli_real_escape_string($this->db->link, $address);
        $country    = mysqli_real_escape_string($this->db->link, $country);
        $zip        = mysqli_real_escape_string($this->db->link, $zip);
        $email      = mysqli_real_escape_string($this->db->link, $email);
        $phone      = mysqli_real_escape_string($this->db->link, $phone);
        
         //check if any of the fields are empty and return error
         if($name == "" || $city== "" || $address == "" ||
         $country == "" || $zip == "" || $email == "" ||
          $phone == ""){
            //set error message
            $msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg; 
         } else{

                //this query will update the product table
                //based on the input fields from the post request
                //with the specified user id from the session
                $query = "UPDATE tbl_customer
                SET 
                name         = '$name',
                city         = '$city',
                address      = '$address',
                country      = '$country',
                zip          = '$zip ',
                email        = '$email',
                phone        = '$phone'
                WHERE id     = '$id'";
 
        //call the update method in the db object class 
          $updated_row = $this->db->update($query);

          //check if inserted_row is inserted successufully
          if ($updated_row) {
    			$msg = "<span class='success'>User details updated successfully.</span> ";
    			return $msg;// Return message 
    		}else {
    			$msg = "<span class='error'>User details were not updated.</span> ";
    			return $msg; // Return message 
            }
        }
    }

    /**
     * This function will take a customer id as input
     * and a post request with several fields.  The data 
     * will first be checked to see if any of the fields 
     * were left empty. If a field was left empty, an error
     * message will be returned.  If the payment table 
     * already has the user identification in one of the rows, 
     * then the data in the table will just be updated using 
     * the form input.  This will be checked by selecting the 
     * row from the payment table based on the user id input. 
     * If updated successfully, a success message will be returned.
     * If the user identification is not in the payment table, 
     * a new row will be inserted into the payment table based 
     * on the user id and form input.  Once it is successfully inserted,
     * a success message will be returned.  
     */
    public function customerPayment($id, $data){

        //validate form input
        $userId = mysqli_real_escape_string($this->db->link, $id);
        $cardname = mysqli_real_escape_string($this->db->link, $data["cardname"]);
        $cardnumber = mysqli_real_escape_string($this->db->link, $data["cardnumber"]);
        $expmonth = mysqli_real_escape_string($this->db->link, $data["expmonth"]);
        $expyear = mysqli_real_escape_string($this->db->link, $data["expyear"]);
        $cvv = mysqli_real_escape_string($this->db->link, $data["cvv"]);

        //check if any of the input fields were left empty
        if( $cardname == "" ||  $cardnumber == "" || $expmonth == "" 
        || $expyear == "" || $cvv == ""){
            $msg = "<span class='error'>All fields must be filled. </span>";
            //return an error message if any field was left empty.  
            return $msg; 
        } else{

            //perform a select query of the payent table 
            //that will return a row based on the user id that 
            //matches the user id in the table.  
            $query = "SELECT * FROM tbl_payment 
                    WHERE payment_userId = '$userId'";

            //use the select query to pass the query that is in the db object class
            $payment_row = $this->db->select($query); 

            
            //if a row is returned do this
            if($payment_row){

                /**
                 * if a row is returned, perform an update query 
                 * on the payment table in the database and set 
                 * the fields in the databse equal to those in the
                 * form input
                 */
                $updateQuery = "UPDATE tbl_payment
                SET 
                cardname                = '$cardname',
                cardnumber              = '$cardnumber',
                expmonth                = '$expmonth',
                expyear                 = '$expyear',
                cvv                     = '$cvv '
                WHERE payment_userId    = '$userId'";
                
                //pass the query to the update function in the db object class
                $update_row = $this->db->update($updateQuery); 

                //if it is successfully updated , return a success message
                if($update_row){
                    $msg = "<span class='success'>Payment information updated successully.</span>";
                    return $msg; 
                } else{
                    //return an error message to the user telling them the information was not updated
                    $msg = "<span class='erro'>Payment information was not updated.</span>";
                    return $msg; 
                }
            } else{

                /**
                 * if the user id is not already in the payment table, then the form data must be inserted
                 * into the database for the specified fields based on the values of the form. 
                 */
                $insertQuery = "INSERT INTO tbl_payment(cardname, payment_userId, cardnumber, expmonth, expyear, cvv) 
                VALUES ('$cardname', '$userId', '$cardnumber','$expmonth','$expyear','$cvv')";
                
                //call the insert function in the db object class and pass the insert query to it.
                $insert_row = $this->db->insert($insertQuery); 

                //if successfully inserted, return a success message.
                if($insert_row){
                    $msg = "<span class='success'>Payment information upated successully.</span>";
                    return $msg; 
                } else{
                    //otherwise, return an error message.  
                    $msg = "<span class='erro'>Payment information was not updated.</span>";
                    return $msg; 
                }
            }
        }
    }

    /**
     * This function will take a user identification as input
     * and select from the payment table in the database 
     * based on the input user id that matches the one in the databse.  
     * The returned object result is then returned.  
     */
    public function getPaymentData($id){

        $userId = mysqli_real_escape_string($this->db->link, $id);

        /**
         * select from the payment table with the condition
         * that the payment_userId field is equal to the input 
         * id field.  
         */
        $query = "SELECT * FROM tbl_payment
                WHERE payment_userId = '$userId'"; 

        /**
         * pass the query to the select method in the db object class 
         * to process the select query.  
         */
        $result = $this->db->select($query); 

        //return the result to the user.  
        return $result;

    }
}

