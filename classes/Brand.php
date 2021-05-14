<?php 
//include all files such as the databse and format files
//to use their corresponding functionality .
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>

<?php


/**
 * The brand class will allow the user to perform all the required functionalities 
 * for the brands of the system such as updating the brands, inserting the brands, 
 * and returning the brands of the system . 
 */

class Brand{

    /**
     * attributes of the class
     */
    private $db;
    private $fm; 

    /**
     * set the attributes of the class upon 
     * creating the class by setting the db and
     * fm attributes equal to new objects of the databse
     * and format classes.  
     */
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * Function that takes a brand name
     * as input, validates the brand name
     * input and inserts that brand name into
     * the brandName field in the brand table
     * The message result returned will either 
     * be an error if the input field is empty, 
     * a success message to indicate that the 
     * item was successfully inserted, or an error 
     * message to tell the user that the item 
     * was not successfully inserted.  
     */
    public function insertBrand($brandName){

        //validate the  input of the user.  
        $brandName = $this->fm->validation($brandName); 

        //perform built in function to escape characters
        $brandName = mysqli_real_escape_string($this->db->link, $brandName); 

        //check if emtpy
        if(empty($brandName)){
            $msg = "<span class='error'>The brand field must not be empty.</span>";
            //return the error message
            return $msg; 
        } else{

            //insert query for the specific brand
            //the value that will be inserted will be the 
            //brandName input
            $query = "INSERT INTO tbl_brand(brandName)
                    VALUES('$brandName')"; 

            /**
             * access the insert method from the 
             * database class and pass the query to it
             */
            $brandInsert = $this->db->insert($query); 

            //check if true 
            if($brandInsert){
                $msg = "<span class='success'>Brand inserted successfully.</span>";
                //return the success message 
                return $msg; 
            }
            //nothing added
            else{
                $msg = "<span class='error'>Brand not inserted.</span>";
                //return the error message
                return $msg; 
            }
        }
    }

    /**
     * Method that performs a query to return
     * all the rows of the tlb_brand table and 
     * orders them by id in descending order
     * The query is then passed to the select 
     * query, which returns all the rows of the 
     * brands table to the user.  
     * 
     */
    public function getAllBrand(){
        //perform the query on the tbl_brand
        //database and order by brand Id in descending order
        $query = "SELECT * FROM tbl_brand
                ORDER BY brandId DESC"; 

        /**
         * pass the query to the select function in the 
         * database class.  
         */
        $result = $this->db->select($query); 

        //return the result
        return $result; 
    }

    /**
     * This function will take the specific brand identifcation
     * and perform a select query on the brands table based 
     * on that brand identification.  
     */
    public function getBrandById($id){
        
        /**
         * Select the row from the brands table
         * based on the brands specific identifcation
         */
        $query = "SELECT * FROM tbl_brand
                WHERE brandId='$id'"; 
        
        //set return object equal to result using select method
        //from the databse class
        $result = $this->db->select($query); 

        //return the query
        return $result; 
    }

    /**
     * function to update the brandName
     * based on the id of the brand. The input
     * is the sepcifed brand name and the brand 
     * id.  First, perform validation on the 
     * field inputs and then check for empty 
     * fields. If a field is empty, return an error
     * message.  If no fields are empty, write the query to update 
     * the date on the tbl_brand and sepcify 
     * the brand name to set and the id. After that
     * , check if update was successfull or an error occurred
     * and return the message.  
     */
    public function updateBrand($brandName, $id){

        //perform validation
        $brandName = $this->fm->validation($brandName); 

        //perform built in function real escape string on brandname and id
        $brandName = mysqli_real_escape_string($this->db->link, $brandName); 

        //perform built in function real escape string on id
        $id = mysqli_real_escape_string($this->db->link, $id); 

        /*
        if the input field is empty, display input field error
        */
        if(empty($brandName)){
            $msg = "<span class='error'>Brand field must not be empty.</span>"; 
            //return the error message
            return $msg; 
        } else{

            //perform the update query at this point
            //update the brand table and set the brand name 
            //equal to the input brand name on the specified brand 
            //based on the brand identifcation.  
            $query = "UPDATE tbl_brand
                    SET brandName='$brandName'
                    WHERE brandId='$id'"; 

            //update the table using the query and the 
            //update method in the database class.  
            $update_row = $this->db->update($query); 

            //if the row is returned and not false, display the success message 
            if($update_row){
                $msg = "<span class='success'>Brand field updated successfully.</span>"; 
                //return the success message 
                return $msg; 
            }  
            //display error message
            else{
                $msg = "<span class='error'>Brand field was not updated.</span>"; 
                //return the error message.  
                return $msg; 
            }
        }
    }

    /**
     * This function takes a unqiue brand identification
     * as input and performs a delete query 
     * on the brand table with the corresponding
     * brand id. A message is then returned depending on the
     * result.  
     */
    public function deleteBrandById($id){

        /**
         * perform the delete query on the databse table 
         * based on the brand identification that matches 
         * the input id of the user.  
         */
        $query = "DELETE FROM tbl_brand
                WHERE brandId = '$id'"; 
        
        //access delete method from the db object
        $delete_brand = $this->db->delete($query); 

        //if successful, return a success message to the user. Otherwise, 
        //return an error message. 
        if($delete_brand){
            $msg = "<span class='success'>Brand field deleted successfully.</span>"; 
            return $msg; 
        } else{
            $msg = "<span class='error'>Brand field not deleted.</span>"; 
            return $msg; 
        }
    }

}





?>

