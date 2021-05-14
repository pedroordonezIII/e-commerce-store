
<?php 
//include the real file path and pass that to the 
//include once built in function to include the config file.  
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/config.php');
 
?>

 

<?php 
/*
This class will be needed to create the database. 
The class will connect to the databse using information
from the config file.  Additionally, the class will 
allow users to perform different queries on the database
with the databse connection.  
*/
 class Database {

//initialize all attributes from the config file 
//that will allow the user to connect to the database
public $host = DB_HOST;
public $user = DB_USER;
public $pass = DB_PASS;
public $dbname = DB_NAME;

//intialize attribute that links the user to the database
 public $link;
 //initialize attribute for errors when connecting to the database
 public $error;

   //automatically create constructor when calling
   //class on object instance
   public function __construct(){
      //call the connectDb method upon instantiating
      //the class
   	$this->connectDB();
   }



//create a new connection with the 
/**
 * This function will create a new connection with the database
 * based on the users congifure file information. An object oriented
 * approach will be used to connect to the database by instantating a
 * new mysqli object with the corresponding user parameter information
 * including the host, user, pass, and dbname attributes initialized 
 * for the config file.  If the connection is not successful, the error 
 * attribute will be instantiated
 */
 private function connectDB(){

   $this->link = new mysqli($this->host,$this->user, $this->pass, $this->dbname);

    if(!$this->link) {
    
     $this->error ="connection fail".$this->link->connect_error;
       return false;
    }
 }
    // Select or Rread Data From Database 
    /**
     * This function will take a sql query as input and
     * will specifically be conerned with handling select 
     * queries in the database.  The built in query function 
     * that is available with the database connection will 
     * be used to process the query.  If 1 or more rows are returned
     * by the query, the result query will be returned to the user. 
     * Otherwise, false will be returned to tell the user that 
     * nothing was returned.  
     */
     public function select($query){
   //will return a mysql result object 
    $result = $this->link->query($query) or die ($this->link->error.__LINE__);
    if($result->num_rows > 0){
       //will be a mysql result object that can be accessed
    	return $result;
    	    } else {
              //if no rows are returned it is false
    	    	return false;
    	    }   

     }

   // Create Data in to the database 
    /***
     * The insert function will take a sql query as input and 
     * will be specifically concerned with inserting data into 
     * the database tables of the system.  This will be done by 
     * calling the query function in the databse link to process the 
     * query of the user.  If the insert query is successful, then 
     * the result will be returned to the user.  Otherwise, false will
     * be returned to inform the user that the insertion was unsuccessful.  
     */
   public function insert($query){
   $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($insert_row){
   	 return $insert_row;
   	 exit();
   	   } else {
   	   	return false;

   	   }

   }

   /// Update Data in to the database

   /**
    * The update function will take a query as input 
    and will be specifically concerned with updating 
    data in the databse.  The built in query function 
    will be used to process the query and if successful, 
    , will return the result object.  Otherwise, false will 
    be returned to the user to indicate that the query was not 
    successful.  
    */
   public function update($query){
   //use mysqli built in query function to perform the query which returns
   //false if unsuccessful or true and a result object if successful
   $update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($update_row){
   	return $update_row;
   	exit();
   	} 
         else {
   	   	return false;
         }
      }




/// Delete Data in to the database
/**
 * The delete function will take a sql query as 
 * input and will be specifically concerned with 
 * deleteing data from the database based on the 
 * sql query.  This query will be processed by 
 * passing the built in query function with the 
 * input query to the database connection.  If 
 * successful, the result object and true will be 
 * returned.  Otherwise, the function will return 
 * false to indicate that the row was not deleted 
 * successfully.  
 */
   public function delete($query){
   $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($delete_row){
   return $delete_row;
   	exit();
   	   } else {
   	  return false;

   	   }

   }

 }


?>