<?php 
/**
 * the real path will be the directory name
 * which is a file. When using the real path,
 * will load the entire path
 */
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>

<?php

/**
 * 
 */

class Product{

    /**
     * private attributes db and fm which will 
     * be instantiated objects for the database and format
     * classed
     */
    private $db;
	private $fm;

    /**
     * The constructor for the class that will be called
     * upon instantiating the product class.  
     */
    public function __construct(){
        $this->db   = new Database();
        $this->fm   = new Format();
    }

    /**
     * function to return the fm attribute
     */
    public function getFm(){
        return $this->fm;
    }

    /**
     * This function will take a post request and file 
     * as input and insert the data into the products 
     * table in the store database.  
     */
    public function insertProduct($data, $file){
         //validate form input using validation function
        //  $productName = $this->fm->validation($productName); 
        //  $catId
        //  $brandId
        //  $
         
         //perform built in function to escape characters, use this to get all post field names
         //before inserting in the database
         $productName   = mysqli_real_escape_string($this->db->link, $data['productName']); 
         $catId         = mysqli_real_escape_string($this->db->link, $data['catId']); 
         $brandId       = mysqli_real_escape_string($this->db->link, $data['brandId']);
         $body          = mysqli_real_escape_string($this->db->link, $data['body']);  
         $price         = mysqli_real_escape_string($this->db->link, $data['price']); 
         $type          = mysqli_real_escape_string($this->db->link, $data['type']); 

         //supported file types
         $permitted = array("jpg", "jpeg", "png", "gif"); 
         
         //handle the images
         //image file name
         $file_name = $file["image"]["name"]; 

         //the image file size
         $file_size = $file["image"]["size"]; 
        
         //file to upload reference
         $file_temp = $file["image"]["tmp_name"]; 
        
         //expode into an array seperated by period
         $div = explode('.', $file_name); 

         //get the last portion of the array which is the 
         //picture extension and make it lower case
         $file_ext = strtolower(end($div)); 
         
         //make the image unique using md5 hash using substr to return a substring 
         //with time from character 0-10
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; 

        //choose place for image to be uploaded. upload folder and the name of the file
         $uploaded_image = "upload/".$unique_image; 

         //check if any of the fields are empty and return error
         if($productName == "" || $catId == "" || $brandId == "" ||
         $body == "" || $price == "" || $type == ""){
            $msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg; 
         } else{
             //upload the images, takes file and location to upload
             move_uploaded_file($file_temp, $uploaded_image);
            
             //insert all the field names and then all the values
             $query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type)
                    VALUES('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', $type )";

            //insert using thr insert query
            $insert_row = $this->db->insert($query);

            //check if successful insert occurred
            if($insert_row){
                //message to display if insert is successful
                $msg = "<span class='success'>Product inserted successfully.</span>";
                return $msg; 
            } else{
                //if an error occurred, display this message
                $msg = "<span class='error'>Product not inserted.</span>";
                return $msg; 
            }

         }
    }

    /**
     * Method to get all products
     * in order to displauy them 
     * It will query all the rows 
     * in the database
     * query passed to select method
     * that returns a reference object
     * to the database table tbl_product
     */
    public function getAllPro(){
        //query to select all rows and order by id
        //perform inner join with category table catName and brand
        //table brandName. Each product in products table corresponds to 
        //the brand and cat id in the other tables.
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                FROM tbl_product
                INNER JOIN tbl_category
                ON tbl_product.catId = tbl_category.catId
                INNER JOIN tbl_brand
                ON tbl_product.brandId = tbl_brand.brandId
                ORDER BY tbl_product.productId DESC";
        //pass query to select method
        $result = $this->db->select($query);
        //return result
        return $result;
    }

    /**
     * Method to select product based 
     * on specific id. The input is an 
     * id, and that id is used in the query
     * to retrieve the correct product 
     * based on the id
     */
    public function getProById($id){
        //query to select all rows from table products
        $query = "SELECT * FROM tbl_product WHERE productId ='$id' ";
        //access select method in db object
        $result = $this->db->select($query);
        //return result
        return $result;
    }

    /**
     * This method will take the form data from the post request,
     * the file which is the picture, and the product
     * id as inputs to update the data in the database
     * There will be two main conditions when inputing
     * dating with the update query. The first one is 
     * when the image field is present and the other 
     * is when the image field is empty. 
     */
    public function productUpdate($data, $file, $id){

        //validate form input using validation function
        //  $productName = $this->fm->validation($productName); 
        //  $catId
        //  $brandId
        //  $
         
         //perform built in function to escape characters, use this to get all post field names
         $productName   = mysqli_real_escape_string($this->db->link, $data['productName']); 
         $catId         = mysqli_real_escape_string($this->db->link, $data['catId']); 
         $brandId       = mysqli_real_escape_string($this->db->link, $data['brandId']);
         $body          = mysqli_real_escape_string($this->db->link, $data['body']);  
         $price         = mysqli_real_escape_string($this->db->link, $data['price']); 
         $type          = mysqli_real_escape_string($this->db->link, $data['type']); 

         //supported file types
         $permitted = array("jpg", "jpeg", "png", "gif"); 
         
         //handle the images
         //image file name
         $file_name = $file["image"]["name"]; 

         //the image file size
         $file_size = $file["image"]["size"]; 
        
         //file to upload reference
         $file_temp = $file["image"]["tmp_name"]; 
        
         //expode into an array seperated by period
         $div = explode('.', $file_name); 

         //get the last portion of the array which is the 
         //picture extension and make it lower case
         $file_ext = strtolower(end($div)); 
         
         //make the image unique using md5 hash using substr to return a substring 
         //with time from character 0-10
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; 

        //choose place for image to be uploaded. upload folder
         $uploaded_image = "upload/".$unique_image; 

         //check if any of the fields are empty and return error
         if($productName == "" || $catId == "" || $brandId == "" ||
         $body == "" || $price == "" || $type == ""){
            $msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg; 
         } else{
             //condition to update with image
             if(!empty($file_name)){
                //validation for file size
                if($file_size > 1054589){
                    echo "<span class='error'>Image must be smaller than 1MB.</span>";
                } 
                //validation for image type
                else if(in_array($file_ext, $permitted) === false){
                    //implode array to list array 
                    echo "<span class='error'>You can only add.".implode(',',$permitted)."images."."</span>";
                }
                else{
                    //upload the images, takes file and location to upload
                    move_uploaded_file($file_temp, $uploaded_image);
                    
                    //query to update the items in the table with the specific id and image
                    $query = "UPDATE tbl_product 
                            SET 
                            productName = '$productName',
                            catId       = '$catId',
                            brandId     = '$brandId',
                            body        = '$body',
                            price       = '$price',
                            image       = '$uploaded_image',
                            type        = '$type'
                            WHERE productId = '$id'";

                    //insert using thr insert query
                    $updated_row = $this->db->update($query);

                    //check if successful insert or update occurred
                    if($updated_row){
                        //message to display if insert is successful
                        $msg = "<span class='success'>Product updated successfully.</span>";
                        return $msg; 
                    } else{
                        //if an error occurred, display this message
                        $msg = "<span class='error'>Product not updated.</span>";
                        return $msg; 
                    }   
                }
            } else{
                //condition without the image upload
                //query to update the items in the table with the specific id
                //without the image
                $query = "UPDATE tbl_product 
                SET 
                productName = '$productName',
                catId       = '$catId',
                brandId     = '$brandId',
                body        = '$body',
                price       = '$price',
                type        = '$type'
                WHERE productId = '$id'";

                //insert using thr insert query
                $updated_row = $this->db->update($query);

                //check if successful insert occurred
                if($updated_row){
                    //message to display if insert is successful
                    $msg = "<span class='success'>Product updated successfully.</span>";
                    return $msg; 
                } else{
                    //if an error occurred, display this message
                    $msg = "<span class='error'>Product not updated.</span>";
                    return $msg; 
                    }   
                }
            }  
        }

    /**
     * This method will take a prodcut id 
     * as input and will delete the row with the product id
     * from the database table and will also
     * delete the image from the image table.  
     * A success or error message will then be returned.  
     */
    public function deleteProById($id){

        //get the specified row with the specfied id
        $query = "SELECT * FROM tbl_product
                WHERE productId = '$id'";
        
        //perform the select query to get the data 
        //and set the getData object equal to getData
        $getData = $this->db->select($query); 
        
        //if returne d
        if($getData){

            //go through all rows of the table with the id
            while($deleteImg = $getData->fetch_assoc()){
                //get the specified link to the image
                $deleteLink = $deleteImg['image']; 
                //delete image from folder and the table
                unlink($deleteLink); 
            }
        }
        
        //query to delete the specified row by the id 
        //on the database table. 
        $deleteQuery = "DELETE FROM tbl_product
                    WHERE productId = '$id'";
        
        //c
        $deleteData = $this->db->delete($deleteQuery); 

        if($deleteData){
            $msg = "<span class='success'>Product deleted successfully.</span>";
            return $msg; 
        } else{
            $msg = "<span class='error'>Product not deleted. </span>";
            return $msg;
        }

    }

    /**
     * This function will get all the 
     * featured products in the database
     * using a select query on the tbl_product
     * table. The type 0 in the database is the 
     * featured product
     */
    public function getFeaturedProduct() {
        //query the database using a select query specifying the 
        //type, the order of the products and the limit amount to obtain
      	 $query = "SELECT * FROM tbl_product WHERE type='0'
            ORDER BY productId DESC LIMIT 4 ";
         $result = $this->db->select($query);
         return $result;
    }

    /**
     * This product will select all the products
     * with the type new using a select query 
     * that returns all the rows of the tbl_products
     * with a limit of 4. 
     */
    public function getNewProduct(){
        //query to access all products from the products table
        //that has the type of one which is the new.
	    $query = "SELECT * FROM tbl_product WHERE type='1' 
        ORDER BY productId DESC LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * This function will perform a select query 
     * on the products table where the type is 2 
     * and order the products based on descending
     * order with a limit of four.  The result object 
     * is then returned.  
     */
    public function getStackProductHome(){
        //perform a select query that returns all the rows based on the condition that the
        //type is equal to 2 and order by the product id.  
        $query = "SELECT * FROM tbl_product WHERE type='2' ORDER BY productId DESC LIMIT 4 ";
        $result = $this->db->select($query);
        //return the result object.
        return $result;
    }

    /**
     * This method will take the product
     * id from the get method as input
     * to select the specified product when 
     * accessing the preview page.  Within 
     * this method, a Select query will be 
     * made on all fields in the products table,
     * the catName field in the category table, 
     * and the brand name field in the brand table. 
     * From there, an inner join to create a new table
     * will be made with the category table with the 
     * id's that correspond with each other in the product 
     * and category table and the brand id in both tables that
     * correspond with each other. The input id is then used 
     * to access the specific product on the id.
     */
    public function getSingleProduct($id){
        /*
        Perform an inner join between the three tables
         */
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_brand
         ON tbl_product.brandId = tbl_brand.brandId
         AND tbl_product.productId = $id
         ORDER BY tbl_product.productId DESC";
         //use the database class object to access the select
         //query
        $result =  $this->db->select($query);
        //return the result.
        return $result;
    }

    /**
     * This function will take a category identification as input
     * and use that category input to return the corresponding 
     * prodcuts with the category identifcation and the category 
     * with the corresponding category id.  The query result object
     * will then be returned.  
     */
    public function productByCat($id){
        $catId  =  mysqli_real_escape_string($this->db->link, $id);
        /**
         * this query will be a select query that returns all the product
         * rows and the category name fields and then inner join the category 
         * table based on the products with the category id and category with the 
         * matching category id.  
         */
        $query = "SELECT tbl_product.*, tbl_category.catName
            FROM tbl_product 
            INNER JOIN tbl_category
            ON tbl_product.catId = $catId
            AND tbl_category.catId=$catId ";
            /**
             * use the select function from the db object and pass the query
             */
            $result = $this->db->select($query);
            /**
             * return the result object
             */
            return $result;
    }

    /**
     * This method will take a brand identificationas as input
     * and select all rows from the products table and the brandName
     * from the brands table.  An inner join of the brands table will be done 
     * where the products brand id is equal to the brand input id
     * and the brand tables brand id is equal to the input brand id.  
     * The result object is then returned.  
     */
    public function productByBrand($id){
        $brandId  =  mysqli_real_escape_string($this->db->link, $id);
        /**
         * select all rows from the products table and the brandName
         * field from the brands table and inner join the brands table
         * based on the products with the input brand id and the brand 
         * tables brand id equal to the brand id.  
         */
        $query = "SELECT tbl_product.*, tbl_brand.brandName
            FROM tbl_product 
            INNER JOIN tbl_brand
            ON tbl_product.brandId = $brandId
            AND tbl_brand.brandId=$brandId ";
            //use the select function in the db object class and pass the query to it
            $result = $this->db->select($query);
            //return the resul object to the user
            return $result;
    }
       
    /**
     * This function will take a category identification as 
     * input and select the fields from the category table 
     * based on the categories unique id.  
     */
    public function productByOnlyCat($id){
        /**
         * The select query will be done on the category table
         * based on the category id  
         */
        $query = "SELECT * FROM tbl_category WHERE catId ='$id' ";
        $result = $this->db->select($query);
        //return the result object.  
        return $result;
    }


    /**
     * This method will search the body and productName
     * fields on the product table to return any products
     * that match with the search keywords.  The input
     * will be the search keywords
     */
    public function productBySearch($search){

        //select query that select all rows from the
        //products table and selects two fields, including
        //the productName and body to compare those inputs
        //with the search input. It will be one or the other
        $query = "SELECT * FROM tbl_product
                WHERE productName LIKE '%$search%' 
                OR body LIKE '%$search%'";
        
        //pass the query to the select method 
        $result = $this->db->select($query); 

        return $result; 
    }
}

?>