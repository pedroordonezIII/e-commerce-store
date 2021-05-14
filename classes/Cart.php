
<?php 
//include the databse and format files using the include once
//built in function.
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>


<?php 
/**
 * The cart class will implement all functionality related to the cart
 * such as adding to cart, getting the cart products, updating the cart 
 * quantity for each item, deleting the cart item, checking the cart table, 
 * and deleting the customer cart.  
 */

class Cart{

    private $db;
    private $fm;

    public function __construct(){
        $this->db= new Database();
        $this->fm = new Format();
    }
    // public function addToCart($quantity, $id){
    //     $quantity = $this->fm->validation($quantity);
    //     $quantity =  mysqli_real_escape_string($this->db->link, $quantity);
    //     $productId =  mysqli_real_escape_string($this->db->link, $id);
    //     $sId = session_id();
    
    //     $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
    //     $result = $this->db->select($squery)->fetch_assoc();
    
    //     $productName = $result['productName'];
    //     $price = $result['price'];
    //     $image = $result['image'];
    
    
    //     $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId ='$sId'";
    //     $getPro = $this->db->select($chquery);
    //     if ($getPro) {
    //         $msg = "Product Already Added!";
    //         return $msg;
    //     }else {
    
    //     $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
    //           VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";  
    
    //           $inserted_row = $this->db->insert($query);
    //           if ($inserted_row) {
    //                  header("Location:cart.php");
    //             }else {
    //                 header("Location:404.php");
    //             } 
    //     }
    // }

    //must include all fields of database table
    /**
     * This method will take the quantity of the 
     * item to be added and a product id for the specified
     * product.  The product will only be allowed to be 
     * added into the cart once. If the product has already
     * been added by the user, then an error will show. 
     * If not, the information will be inserted into the database table
     * , the user will be redirected to the cart page  
     *  
     */
    public function addToCart($quantity, $id){
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        //get the current session id 
        $sId = session_id();

        //get matching product
        $squery = "SELECT * FROM tbl_product 
            WHERE productId = '$productId'"; 
        
        $result = $this->db->select($squery)->fetch_assoc(); 
        
        if($result){
            //show display
            // echo "<pre>"; 
            // print_r($result);
            // echo "</pre>"; 

            /**
             * get the productName, price, and image
             * fields from the tbl_product
             */
            $productName = $result['productName'];
            $price = $result['price']; 
            $image = $result['image'];  

            //check if product is already in the table
            //by selecting row that has that specified productID
            //and the session id. ONly one produc can be added 
            //per session, but the quantity can be updated
            $chequery = "SELECT * FROM tbl_cart2 
            WHERE productId = '$productId' 
            AND sId ='$sId'"; 

            //pass the query to the select to return the items
            $getProd = $this->db->select($chequery); 

            //do not allow items to be added again
            if($getProd){
                $msg = "<span class='error'>The product was already added!</span>"; 
                return $msg;
            }else{
                // $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) 
                // VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";  

                //insert data into the cart page
                $query = "INSERT INTO tbl_cart2(sId, productId, quantity) 
                    VALUES ('$sId','$productId', '$quantity')";  

                $inserted_row = $this->db->insert($query);

                if ($inserted_row) {
                //if inserted, redirect to the cart page  
                    header("Location:cart.php");
                }else {
                    //if not inserted, redirect to the 404 page
                    header("Location:404.php");
                } 
            }
        }
    }

    /*
    This method gets all the products from the 
    cart table with the specified session id. This
    method is used to access all cart fields to display.  
    To get all data, perform an inner join on
    the tbl_products based on the productId.
    */
    public function getCartProduct(){
        //intialize the session id
        $sId = session_id();
        //perform select query with inner join of product table to access product table fields
        //such as the product name, price, and image
        $query = "SELECT tbl_cart2.*, tbl_product.productName, tbl_product.price,
            tbl_product.image
            FROM tbl_cart2
            INNER JOIN tbl_product
            ON tbl_cart2.productId = tbl_product.productId
            WHERE sId = '$sId'";
            //access the select query from the databse class and pass the specific query to it
            $result= $this->db->select($query);
            //return the result.  
            return $result;
    }

    // public function getCartProduct(){
    //     $sId = session_id();
    //     $query = "SELECT * FROM tbl_cart WHERE sId ='$sId' ";
    //        $result = $this->db->select($query);
    //        return $result;
  
    // }
    
    /**
     * This method takes a quantity for the cart and 
     * and a cart id for the speicifc item to update in the 
     * cart.  The query will be an update query that updates
     * the cart table and the fields such as the quantity and 
     * cartId in the cart table.  
     */
    public function updateCartQuantity($quantity, $id){
        //before adding into the database, use this for validation
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $id);

        /*
        Update the cart table fields such as the quantity
        based on the specified cart Id in the cart table.  
        */
        $query = "UPDATE tbl_cart2
                SET quantity='$quantity'
                WHERE cartId='$cartId'"; 
        
        //access the update query in the database class
        //and pass the query to update it.  
        $update_quantity = $this->db->update($query); 

         //check if something is returned and show message
         if($update_quantity){
            //redirect the user to the cart page  if the update is successful  
           header("Location:cart.php");
        }else{
            $msg = "<span class='error'>Quantity not updated.</span>";
            //return error message
            return $msg; 
        }
    }

    
    /**
     * This method will take the cart id as input
     * and delete the specified cart row with the id
     * from the cart table. Once the row is deleted,
     * the paged is reloaded using window.location. Otherwise,
     * an error message will show telling the user that 
     * the cart row was not deleted.   
     */
    public function deleteCartItem($id){

        //validation 
        $cartId = mysqli_real_escape_string($this->db->link, $id);

        //delete from the cart based on the 
        //cartid in the table
        $query = "DELETE FROM tbl_cart2 
                WHERE cartId = '$cartId'"; 
        
        //perform the deletion
        $delete_query = $this->db->delete($query);

        //check if something is returned and show message
        if($delete_query){
            // $msg = "<span class='success'>Item deleted successfully.</span>";
            echo "<script>window.location = 'cart.php';</script>";
            //return $msg; 
        }else{
            $msg = "<span class='error'>Item not deleted.</span>";
            //return an error message telling the user that the item was not deleted
            return $msg; 
        }

    }

    /**
     * This method will query the cart table based 
     * on the current session id. If data is present,
     * it will return all the rows of the table based
     * on the matching session id. 
     */
    public function checkCartTable(){
        //get the current session
        $sId = session_id();
        //perform select query with inner join of product table
        $query = "SELECT * FROM tbl_cart2 
                WHERE sId='$sId'";

        $result = $this->db->select($query); 
        return $result;
    }

    /**
     * This method will delete the customer cart based on the 
     * session identification.  A delete query of the cart table
     * will be performed based on the session identification of 
     * the current user.  
     */
    public function deleteCustomerCart(){
        //get the current session id and set it equal to 
        //the sId variable using php built in funcion
        $sId = session_id(); 

        //query to delete the data with the specified session id
        $query  = "DELETE FROM tbl_cart2 WHERE
                sId='$sId'";

        //call the delete query which will remove data from the databse
        //based on the delete query
        $this->db->delete($query); 
    }

}

?>