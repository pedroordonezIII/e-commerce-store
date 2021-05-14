<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php

/**
 * The wishlist class will allow customers to add items to their wishlist
 * table in the databse, check the wish list data, delete wishlist data, and
 * more. 
 */
class Wishlist{

    /**
     * instantiate the attributes for the class
     */
    private $db;
    private $fm;

    /**
     * Constructor that will be called when instantiating the 
     * wishlist class
     */
    public function __construct(){
        /**
         * 
         */
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * This method takes the product Id and the user Id
     * as input and uses this input data to insert the data
     * into the database.  Before placing the data into the 
     * wishlist table, the method will perform a select query 
     * on the table to check if any product is already in the table
     * for the specified user. If the data is already in there, return 
     * a message to the user. Otherwise, insert the productid and the userid
     * into the table.  
     */
    public function saveWishListData($id, $userId){

        //validation
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $userId = mysqli_real_escape_string($this->db->link, $userId);


        //check if product is already in the table
        //by selecting row that has that specified productID
        //and the userId. Only one product of a specific ID
        //can be added for each user in the table. Each user
        //will have one or many entries in the table
        $chequery = "SELECT * FROM tbl_wlist2 
        WHERE productId = '$productId' 
        AND userId ='$userId'"; 

        //pass the query to the select to return the items
        $getProd = $this->db->select($chequery); 

        //do not allow items to be added again if user already has it in
        //their wishlist
        if($getProd){
            $msg = "<span class='error'>The product was already added to the Wishlist!</span>"; 
            return $msg;
        }else{

            //this query will insert data into the wishlist table,
            //creating a row with an id for each item, but each row
            //will have a specific userId for each user of the system
            $query = "INSERT INTO tbl_wlist2(userId, productId)
                    VALUES('$userId', '$productId')"; 
            
            //insert into the database by accessing the db object class
            //and passing the query
            $insert_row = $this->db->insert($query);
            
            //check for success and error and display message to the user
            if($insert_row){
                // $msg = "<span class='success'>Item added to wishlist successfully.</span>";
                // return $msg; 
                header("Location:wishlist.php");
            } else{
                $msg = "<span class='error'>Item was not added to wishlist.</span>";
                return $msg;
            }
        }   
    }

    
    /**
     * This method takes a user id as input 
     * and performs a select query on the 
     * wishlist table to see if any data is 
     * returned from the wishlist when the specified
     * user id is in the the table.  The rows are then 
     * returned by the method. 
     */
    public function checkWlistTable($id){

        //perform validation
        $userId = mysqli_real_escape_string($this->db->link, $id);

        //select query that selects all rows from the 
        //wishlist table where the user Id is equal to the 
        //passed user id. 
        $query = "SELECT * from tbl_wlist2 
                WHERE userId='$userId'
                ORDER BY id DESC"; 

        //access the select method to query the databse
        $select_data = $this->db->select($query); 

        //retirn the data
        return $select_data; 
    }


    /**
     * This message takes a user id as input
     * for the current session and performs 
     * a select query on the wishlist table,
     * the productName field in the product
     * table, and the image from the product
     * image table. An inner join is performed 
     * from the product table to join the product
     * and the wishlist table based on matching 
     * product Id's and user Id's. The result is 
     * then returned. 
     */
    public function getWishListProduct($id){
        //validate user ID
        $userId = mysqli_real_escape_string($this->db->link, $id);

        //perform a query on the database by performing an inner join with the
        //products table in the database
        $query = "SELECT tbl_wlist2.*, tbl_product.productName, tbl_product.price,
            tbl_product.image
            FROM tbl_wlist2
            INNER JOIN tbl_product
            ON tbl_wlist2.productId = tbl_product.productId
            WHERE userId = '$userId'";

            //retrieve the data using the select methoid
            //from the db object class and pass the query to
            //it.
            $result= $this->db->select($query);

            //return the result. 
            return $result;
    }


    /**
     * This method will take a product id as input
     * for the specific data to remove and a userId
     * based on the session of the user. This data is
     * then used to delete data from he wishlist table 
     * based on the matching userId and product id
     * The return will be an error message if an 
     * error occurs and if no error occurs, the window
     * is reloaded. 
     */
    public function deleteWlistData($id, $userId){

        //validate product and user id's
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        //query to delete row from the wlist table based on the 
        //user id and the product id that are the same as the current 
        //usersId for the session and the productId of the product to delete
        $query = "DELETE FROM tbl_wlist2
                WHERE userId = '$userId'
                AND productId = '$productId'"; 

        //access the delete method from the db object class
        //and pass the delete query to it
        $delete_item = $this->db->delete($query); 

        //if something is returned, perform this
        if($delete_item){
            //$msg = "<span class='success'>Item removed successfully.</span>";
            echo "<script>window.location = 'wishlist.php';</script>";
           
        } else{
            //error message
            $msg = "<span class='error'>Item failed to remove.</span>";
            return $msg; 
        }
    }

}


?>