<?php
//include all necessary files using include_once built in function 
//to include the databse and format files. 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php

/**
 * This class will perform several administator 
 * functionalities such as allowing the admin 
 * to update their admin details and also allowing
 * the admin to get their details based on their specific 
 * identification.  
 */

class Admin{

    //create properties
    private $db; 
    private $fm; 

    //initalize constructor to be called when creating an object instance of the class
    public function __construct(){
        //create objects of the class
        //these objects correspond to properties
        $this->db = new Database(); 
        //new format object
        $this->fm = new Format();

    }

    /**
     * This function will take the specific admins unique identification
     * and form data submitted through a post request as parameters.  
     * Initially, all data will be validated using the built in 
     * mysqli_real_escape_string which takes the databse connection
     * and the specific user input.  IF a field is left empty, an 
     * error message will be displayed to the user telling them 
     * that all fields must be filled.  Otherwise, 
     * an update query of the admin table that 
     * updates all the fields in the admin table 
     * will be done with the specific input information
     * for the admin with the specific unique identification. 
     * If the table row is successfully updated, a success 
     * message will be displayed to the user.  
     */
    public function updateAdminDetails($id, $data){


        //validate information before inserting into the database
        $adminId = mysqli_real_escape_string($this->db->link, $id);

        $adminName = mysqli_real_escape_string($this->db->link, $data["name"]);

        $adminEmail = mysqli_real_escape_string($this->db->link, $data["email"]);

        $adminUsername = mysqli_real_escape_string($this->db->link, $data["username"]);

        //check for empty input fields and return error message if any field is left empty.  
        if($adminName == ""  || $adminEmail == "" || $adminUsername == ""){
            $msg = "<span class='error'>All fields must be filled.</span>";
            return $msg;
        } else{

            /**
             * perform an update query of the admin table and 
             * set the specified fields to the users input information
             * for the admin with the unique identification.
             */
            $query = "UPDATE tbl_admin
            SET adminName='$adminName', adminUser='$adminUsername',
            adminEmail='$adminEmail'
            WHERE adminId='$adminId'";

            $update_row = $this->db->update($query); 

            //if successfully updated, return a success message to the user.  
            if($update_row){
                $msg = "<span class='success'>Admin details updated succesfully.</span>";
                return $msg;
            } else{
                //if update is unsuccessful, return a message telling the user that details were not updated
                $msg = "<span error='success'>Admin details were not updated.</span>";
                return $msg;
            }
        }
    }


    /**
     * This function will take the admins unique identifcation
     * as input, which will be set for each users session upon
     * loggin in.  Once input is validated, a select query of 
     * the admin table to return all rows will be done based
     * on the admins unique identification for the current session.  
     */
    public function getAdminData($id){

        $adminId = mysqli_real_escape_string($this->db->link, $id);

        /**
         * perform a select query of the admin table based 
         * on the admins unique identification that matches 
         * one from the table rows.  
         */
        $query = "SELECT * FROM tbl_admin
                WHERE adminId = '$adminId'"; 
        
        /**
         * Call the select query from the db object class 
         * that will perform this query.  
         */
        $select_rows = $this->db->select($query); 

        /**
         * return the object result to the user.  
         */
        return $select_rows; 
    }
}

?>