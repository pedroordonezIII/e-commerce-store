<?php 
 $filepath = realpath(dirname(__FILE__));
 //include files to instantiate objects of the classes in these files
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>


<?php

/**
 * The order class will implement all functions related to 
 * the orders table in the database. 
 */

class Order{

    /**
     * private attributes instantiated 
     * in the class constructor upon
     * instantiating an object of the 
     * order class
     */
    private $db;
    private $fm;

    /**
     * constructor of the class that will
     * be called upon creating an order object
     */
    public function __construct(){
        //set the db attribute equal to a new database object
        $this->db= new Database();
        //set the fm atrribute equal to a new format object
        $this->fm = new Format();
    }

    /**
     * This function will take the user identifcation for the 
     * current user in the current session as input.  Initially, 
     * all the fields and rows of the cart table will be selected and an 
     * inner join of the products table will be performed based 
     * on the product id's of all that products in the cart that 
     * match the ones in the product table. All the fields will be 
     * returned based on the current users session.  If successfully
     * returned, several fields returned will be inserted into the 
     * orders table and the product id and order id will be inserted
     * into the product orders table in the database for each product
     * and order.  
     */
    public function orderProduct($userId){
        //
        //$userId = mysqli_real_escape_string($this->db->link, $id);

        //get the current session id of the user
        $sId = session_id();

        //perform a select query on cart table with inner join of product table
        //that will retrieve the products that are in the cart 
        //based on the product id and get the productName and price fields for 
        //the carts with the current session id. 
        $query = "SELECT tbl_cart2.*, tbl_product.productName, tbl_product.price
            FROM tbl_cart2
            INNER JOIN tbl_product
            ON tbl_cart2.productId = tbl_product.productId
            WHERE sId = '$sId'";

        //pass the query to they select function in the db object class
        $getCart = $this->db->select($query);

        //if something is returned
        if($getCart){

            //iterate through all the returned content 
            while($result = $getCart->fetch_assoc()){
                
                //set the variables based on those in the select query done on the cart and product tables
                $productId  = $result["productId"]; 
                $quantity   = $result["quantity"]; 
                $price      = $result["price"]; 
                
                //calculate the total price for the order entry 
                $totalPrice = $price * $quantity;

                //perform an insert query to the orders table based on the values retrieved and the user id
                $insertOrder = "INSERT INTO tbl_order2(userId, quantity, price, totalPrice)
                        VALUES('$userId', '$quantity', '$price', '$totalPrice')";
                
                //call the insert method in the db database class and pass the query to it
                $insertedOrder = $this->db->insert($insertOrder); 


                 /**
                * this query will select the data from the orders table
                * based on the user identification that is specified for
                * each order that is placed by the user. This will allow 
                * all rows for the current users orders to be returned
                */
                $queryOrder = "SELECT * FROM tbl_order2
                WHERE userId = '$userId'"; 

                $getOrder = $this->db->select($queryOrder);

                //check if any order is returned by the query for the current user
                if($getOrder){
                    //fetch the rows into an associative array
                    //and loop throuh each entry until false is returned
                    //when no more rows are present
                    while($order = $getOrder->fetch_assoc()){

                        //get the order ID from the query returned for the 
                        //users orders for each row
                        $orderId = $order["orderId"];
                         //get the product ID from the query return for the orders of each row
                    
                    
                        //check the product order table to make sure that the 
                        //order has not yet been inserted into the database
                        $chequery = "SELECT * FROM tbl_product_orders
                        WHERE order_id = '$orderId'";

                        $getProd = $this->db->select($chequery); 
                    
                        //if the order has already been inserted into the table, continue on
                        if($getProd){

                            continue;

                        }
                        //otherwise
                        else{

                            //perform an insert query that inserts the product ID and order ID into the table
                            $insertProductOrder = "INSERT INTO tbl_product_orders(product_id, order_id)
                            VALUES('$productId', '$orderId')";
                    
                            $insertOrder = $this->db->insert($insertProductOrder); 
                    }
                }
            }
        }
    }
}


        /**
         * This function will take a user id as input 
         * and perform a select of the product orders 
         * table in the databse and also perform 
         * inner joins of the products and ordes 
         * table based on the foreign key fields 
         * in the product orders table that match
         * the corresponding product and order ids 
         * in the products and orders table of the databse.  
         * In addition, the rows in the orders table will 
         * only be returned for those orders with the 
         * corresponding user id.  The query result is then
         * returned.  
         */
        public function getOrderDetails($id){

            /**
             * Perform a select query of the product orders table and inner joins
             * of the products and orders table based on the product id and order id
             * foreign keys in the prodcut orders table that matches the ones in the 
             * products and orders table.  
             */
            $query = "SELECT tbl_product_orders.*, tbl_product.productName, tbl_product.image,
            tbl_order2.quantity, tbl_order2.totalPrice, tbl_order2.date, tbl_order2.status
            FROM tbl_product_orders
            INNER JOIN tbl_product
            ON tbl_product_orders.product_id = tbl_product.productId
            INNER JOIN tbl_order2
            ON tbl_product_orders.order_id = tbl_order2.orderId
            WHERE userId = '$id'
            ORDER BY date DESC";

            //call the select function in the db object class and pass the select query
            $orderDetails = $this->db->select($query); 

            //return the result.  
            return $orderDetails;
        }



        /**
         * 
         */
        //public function deleteProductOrder()


        /**
         * This function will take a user id as input and 
         * perform a select query on the orders table to check 
         * if any orders corresponding to the current user id
         * are present in the orders table.  The rows will then 
         * be returned if available.  
         */
        public function checkOrderTable($id){

             $userId = mysqli_real_escape_string($this->db->link, $id);

            /**
             * perform a select query on the orders table
             * with the condition that the userid is equal to the 
             * the current users id .  
             */
             $query = "SELECT * FROM tbl_order2
                    WHERE userId = '$userId'";

            //pass the query to the select function in the db object class 
            $result = $this->db->select($query); 
            
            //return the result.  
            return $result;
        } 


        /**
         * This function will get all user orders in the database 
         * and retrieve all specified fields.  Additionally it will
         * perform inner joins of the product and orders table based 
         * on the matching product id and order id's in the product 
         * orders table in the database with those in the products 
         * and orders tables.  
         */
        public function getAllUserOrders(){

            /**
             * Select query to return all the fields and rows of the product orders table
             * and an inner join of the products and orders table based on the product and 
             * order id's in the product orders table that match the primary keys of the 
             * products and orders table in the databse.  This will return all orders with 
             * the corresponding products and several fields in the products and orders 
             * table to display the orders
             */
            $query = "SELECT tbl_product_orders.*, tbl_product.productName, tbl_product.image,
            tbl_order2.userId, tbl_order2.quantity, tbl_order2.totalPrice, tbl_order2.price, tbl_order2.date, 
            tbl_order2.status
            FROM tbl_product_orders
            INNER JOIN tbl_product
            ON tbl_product_orders.product_id = tbl_product.productId
            INNER JOIN tbl_order2
            ON tbl_product_orders.order_id = tbl_order2.orderId
            ORDER BY date DESC";

            //call the select function in the db object class and pass the query to the function
            $result = $this->db->select($query); 

            //return the result 
            return $result;
        }


        /**
         * This function will seelct all the 
         * entries in the orders table and 
         * after that, it will select all the 
         * rows using the select function in the 
         * databse class.  After that, an associative
         * array of the table rows will be used and 
         * after each iteration, the order count will 
         * be updated.  Once the loop finishes, the 
         * order count will be returned
         */
        public function countOrders(){

            //select all the rows from the orders table
            $query = "SELECT * FROM tbl_order2"; 

            //call the select function in the db object class and pass the query
            $table_rows = $this->db->select($query);

            //set the order count variable to one to initially have zero orders
            $orderCount = 0;
            //if select query returns data perform this
            if($table_rows){
                //iterate through each row. Fetch assoc makes the object query into an associative arrayS
                while($result = $table_rows->fetch_assoc()){
                    //increment order count after accessing each row 
                    $orderCount++; 
                }
            }

            //return the final order count
            return $orderCount; 
        }


        /**
         * This function will take an order id as input 
         * and perform an upate query on the orders table 
         * and set the order status to one based on the 
         * order id field that matches the order id input.
         * A success or error message will then be returned. 
         */
        public function shippedProduct($id){

            $orderId = mysqli_real_escape_string($this->db->link, $id);
            // $userId = mysqli_real_escape_string($this->db->link, $id);
            // $price = mysqli_real_escape_string($this->db->link, $price);
            // $total = mysqli_real_escape_string($this->db->link, $total);
            // $date = mysqli_real_escape_string($this->db->link, $date);


            /**
             * update the orders table in the database by setting the 
             * order status to one for the order id field that matches
             * the input order id.  
             */
            $query = "UPDATE  tbl_order2
                    SET status = '1'
                    WHERE orderId = '$orderId'";
            
            //access the update function in the db class and pass the query to it
            $update_row = $this->db->update($query);

            //if the update is true, show a success message, otherwise show an error message
            if($update_row){
                $msg = "<span class='success'>Update Successful.</span>";
                //return the success message
                return $msg;
            } else{
                $msg = "<span class='error'>Update Unsuccessful.</span>";
                //return an error message
                return $msg;
            }
            
        }

        /**
         * This function will take an order id as input 
         * and perform a delete query to delete the 
         * corresponding order from the orders table in 
         * the database.  
         */
        public function deleteShippedOrderAdmin($id){

            $orderId = mysqli_real_escape_string($this->db->link, $id);
            // $userId = mysqli_real_escape_string($this->db->link, $id);
            // $price = mysqli_real_escape_string($this->db->link, $price);
            // $total = mysqli_real_escape_string($this->db->link, $total);
            // $date = mysqli_real_escape_string($this->db->link, $date);

            /*
            Delete query to delete rows from both tables containing the orders
            by performing an inner join on the tables based on the matching
            orderId from both tables. The order will be deleted based on the 
            orderId of the product to be deleted.
            */
            $query = "DELETE tbl_product_orders, tbl_order2
                    FROM tbl_product_orders
                    INNER JOIN tbl_order2
                    ON tbl_product_orders.order_id = tbl_order2.orderId
                    WHERE tbl_product_orders.order_id = '$orderId'";
    
            $deleteData = $this->db->delete($query); 

            if($deleteData){
                $msg = "<span class='success'>Order deleted successfully.</span>";
                echo "<script>window.location = 'mainorder.php';</script>";
                //return $msg; 
            } else{
                $msg = "<span class='error'>Order not deleted. </span>";
                return $msg;
            }
        }


         /**
         * This function will take an order id as input and 
         * delete the order from the orders table and product
         * orders table in the database.  
         */
        public function deleteShippedOrder($id){

            $orderId = mysqli_real_escape_string($this->db->link, $id);
            // $userId = mysqli_real_escape_string($this->db->link, $id);
            // $price = mysqli_real_escape_string($this->db->link, $price);
            // $total = mysqli_real_escape_string($this->db->link, $total);
            // $date = mysqli_real_escape_string($this->db->link, $date);

            /*
            Delete query to delete rows from both tables containing the orders
            by performing an inner join on the tables based on the matching
            orderId from both tables. The order will be deleted based on the 
            orderId of the product to be deleted.
            */
            $query = "DELETE tbl_product_orders, tbl_order2
                    FROM tbl_product_orders
                    INNER JOIN tbl_order2
                    ON tbl_product_orders.order_id = tbl_order2.orderId
                    WHERE tbl_product_orders.order_id = '$orderId'";
    
            $deleteData = $this->db->delete($query); 

            if($deleteData){
                $msg = "<span class='success'>Order deleted successfully.</span>";
                echo "<script>window.location = 'order.php';</script>";
                //return $msg; 
            } else{
                $msg = "<span class='error'>Order not deleted. </span>";
                return $msg;
            }
        }

        /**
         * This function will take an order id as input 
         * and insert the order into the order history table.  
         */
        public function insertOrderHistory($id){

            $orderId = mysqli_real_escape_string($this->db->link, $id);

            /**
             * select all rows and columns from the product orders table
             * and perform inner joins of the product and orders table 
             * based on the matching product id and order id fields in the 
             * product orders table that corresponds to those in the products 
             * and orders tables.  
             */ 
        
            $query = "SELECT tbl_product_orders.*, tbl_product.productId, 
            tbl_product.productName, tbl_product.image, tbl_order2.userId, tbl_order2.quantity, 
            tbl_order2.price, tbl_order2.totalPrice, tbl_order2.date, tbl_order2.status
            FROM tbl_product_orders
            INNER JOIN tbl_product
            ON tbl_product_orders.product_id = tbl_product.productId
            INNER JOIN tbl_order2
            ON tbl_product_orders.order_id = tbl_order2.orderId
            WHERE orderId = '$orderId'
            ORDER BY date DESC";

            // $query = "SELECT * FROM tbl_order2 
            //     WHERE orderId = '$orderId'"; 
            
            $order_data = $this->db->select($query); 

            if($order_data){

                $order_result = $order_data->fetch_assoc(); 

                $userId = $order_result["userId"]; 
                $productId = $order_result["productId"]; 
                $productName = $order_result["productName"]; 
                $productImage = $order_result["image"]; 
                $quantity = $order_result["quantity"]; 
                $price = $order_result["price"]; 
                $totalPrice = $order_result["totalPrice"]; 
                $status = $order_result["status"]; 
                $date = $order_result["date"]; 

                $insert_query = "INSERT INTO tbl_order_history(orderId, userId, productId, productName,
                productImage, quantity, price, totalPrice, status, date)
                                VALUES ('$orderId', '$userId', '$productId', '$productName', 
                                '$productImage','$quantity','$price', '$totalPrice', '$status', 
                                '$date')"; 

                $insert_return = $this->db->insert($insert_query); 

            }
        }

        /**
         * This function will take a user id as input 
         * and perform a select query of the order history 
         * table and return the order history of the user 
         * on the condition that the row has the corresponding 
         * user id.  The returned query is then returned. 
         */
        public function getOrderHistoryById($id){
            $userId = mysqli_real_escape_string($this->db->link, $id);

            /**
             * select query of all rows and columns of the order history table
             * on the condition that the users current id is that of the user
             * id field in the table.  
             * 
             */
            $query = "SELECT * FROM tbl_order_history
                    WHERE userId = '$userId'"; 
            
            //call the select function in the db object class and pass the query
            $orderHistory = $this->db->select($query); 

            //return the result
            return $orderHistory; 
        }

         /**
         * The function will select all the rows from the 
         * order history and all the columns in the table 
         * using a select query. The result is then returned
         */
        public function getAllOrderHistory(){
            //select query of the order history table
            //for all the rows and columns in the table
            $query = "SELECT * FROM tbl_order_history"; 

            //call the select function in the db class and pass the query
            $orderHistory = $this->db->select($query); 

            //return the result to the user
            return $orderHistory; 
        }

        /**
         * This function will select all the rows from the 
         * order history table and count the amount of entries
         * in the table by iterating each row and updating the count.
         * The order count is then returned.  
         */
        public function countHistory(){

            //select query that selects all rows and columns 
            //of the order history table. 
            $query = "SELECT * FROM tbl_order_history"; 

            //call the select function in the db object class and pass the query
            $table_rows = $this->db->select($query);

            //set the order count to 9
            $orderCount = 0;
            //if content is returned and it is not false do this
            if($table_rows){
                //iterate through the table rows which are now in the form of an associative array due to the
                //fetch assoc function
                while($result = $table_rows->fetch_assoc()){
                    //increase the order count after each iteration of the array or row
                    $orderCount++; 
                }
            }
            //return the order count
            return $orderCount; 
        }
    }
?>