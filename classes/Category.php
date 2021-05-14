<?php 
 $filepath = realpath(dirname(__FILE__));
 //connect to the database
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>

<?php


/**
 * This class will implement all functionality related to the 
 * category table in the databse.  Some of the functionalities 
 * include in this class are functions to create, insert, update,
 * and delete categories from the categories table in the database.  
 */
class Category{
    /**
     * private attributes
     */
    //attributes for database class
    private $db;
    //attributes for format class
    private $fm; 

    /**
     * constructor to intitialize objects 
     * upon instantiating class
     */
    function __construct(){
        $this->db = new Database();
        $this->fm = new Format(); 
    }

    /**
     * This method takes a category
     * name is input, validate the input
     * and add the category into the category table in the database
     * If the insert is successful, a success message 
     * will be returned and if an error occurs,
     * an error message will be returned
     */
    public function insertCat($catName){

        //validate form input using validation function
        $catName = $this->fm->validation($catName); 

        //perform built in function to escape characters
        $catName = mysqli_real_escape_string($this->db->link, $catName); 
        
        //check for emptyness
        if(empty($catName)){
            //msg for emtpy fields
            $msg = "The category field must not be empty."; 
            //return the message
            return $msg;
        } else{
            //query to insert into category table and catName field
            //based on the form input
            $query = "INSERT INTO tbl_category(catName)
                    VALUES('$catName')";
            //insert into database using insert query in db object class
            $catInsert = $this->db->insert($query); 
            
            //check if it returns true
            if($catInsert){
                //message to display if insert is successful
                $msg = "<span class='success'>Category inserted successfully.</span>";
                //return the success message
                return $msg; 
            } else{
                //if an error occurred, display this message
                $msg = "<span class='error'>Category not inserted.</span>";
                //return the error message.
                return $msg; 
            }
        }
    }

        /**
         * This function performs a query
         * and returns all the rows from the 
         * category table in the database and 
         * orders the return values by category id in
         * descending order.
         * The select method in the db object class is called 
         * and the returned object is set to the result variable and
         * returned
         */
        public function getAllCat(){
            //query to read all data from the category table in 
            //the database and order it in descending order
            $query = "SELECT * FROM tbl_category 
                ORDER BY catId DESC"; 
            //execute the select method from db object
            $result = $this->db->select($query); 
            //return the result query object
            return $result; 
        }

        /**
         * This method takes an category id as input 
         * and returns all the rows from the 
         * category table in the databse with the corresponding
         * category id. The object result from the 
         * query is returned
         */
        public function getCatById($id){
            //query will return all table rows where 
            //category id is equal to input id
            $query = "SELECT * FROM tbl_category 
                WHERE catId = '$id'"; 
            //execute the select method from db object class and pass the query to it
            $result = $this->db->select($query); 
            //return object reference
            return $result;
        }

        /**
         * This method will take a category name as input 
         * and a category id as input for the specific category
         * to update in the category table in the database.  
         * Initially, the input will be validated and then 
         * the category name field will be checked to see if 
         * it is empty.  If empty, an error will be returned.  
         * Othewise, an update query will be performed in the 
         * category table in the database based on the category 
         * id.  Once it is inserted, a success message will be 
         * displayed.  
         */
        public function updateCat($catName, $id){
            //validate form input using validation function
            $catName = $this->fm->validation($catName); 

            //perform built in function to escape characters
            $catName = mysqli_real_escape_string($this->db->link, $catName); 
            
            //perform built in function to escape characters on id
            $id = mysqli_real_escape_string($this->db->link, $id);

            //check for emptyness
            if(empty($catName)){
                //msg for emtpy fields
                $msg = "<span class='error'>Category field must not be empty.</span>";
                //return the message
                return $msg;
            }else{
                /**
                 * This query will update the category name in
                 * the category table based on the corresponding 
                 * category id in the databse row.  
                 */
                $query = "UPDATE tbl_category
                        SET catName='$catName'
                        WHERE catId='$id'"; 
                //to access, access the object using update query
                $update_row = $this->db->update($query);
                //check if something is returned
                if($update_row){
                    $msg = "<span class='success'>Category field updated successfully.</span>";
                    //return the success message.  
                    return $msg; 
                }else{
                    $msg = "<span class='error'>Category field not updated.</span>";
                    //return the error message to the user.  
                    return $msg; 
                }
            }
        }

        /**
         * This method will take a category id as input to delete
         * the category from the database table.
         * A delete query will be made to the category table 
         * where the item with the matching category is 
         * deleted. A success message will be displayed if the 
         * delete query is successful, otherwise an error will be displayed.  
         */
        public function deleteCatById($id){

            /**
             * this query will delete an entry from the 
             * category table in the databse based on the input 
             * category identfication.  
             */
            $query = "DELETE FROM tbl_category
                    WHERE catId = '$id'"; 
            
            /**
             * To process the query, the delete function 
             * in the databse object class will be accessed 
             * and the query will be passed to it.  
             */
            $deleteData = $this->db->delete($query); 

            //if true and successful, return success message, otherwise, 
            //return an error message.
            if($deleteData){
                $msg = "<span class='success'>Category deleted successfully.</span>";
                return $msg; 
            } else{
                $msg = "<span class='error'>Category field not deleted. </span>";
                return $msg;
            }
        }
}

?>