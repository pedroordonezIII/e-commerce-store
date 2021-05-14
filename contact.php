<?php
include("inc/pageheader.php"); 
?>


<?php 

//check for the post method and submit 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

    //call the insert user message function and pass the post array
    //to it to insert the message into the contact table in the contact class
    $insertMessage = $contact->insertUserMessage($_POST); 
}

?>

<div>
    <div>
    	<div>
  			<div>
  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp;</span></p>
  				<p> 
                Contact us if you encounter any issues or need additional information. We have someone available to 
                help you solve any issues you encounter 24 hours daily.  
                </p>
  			</div>
  			<div></div>
  		</div>
    	    <div>
				  	<h2>Contact Us</h2>
                      <?php 
                      //check if the insert message variable is set
                     if(isset($insertMessage)){
                    echo $insertMessage;
                    }
                    ?>
                      <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Name" />
                            <small id="nameHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input class="form-control" type="text" name="email" placeholder="Enter Email" />
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="mobilenumber">Phone No.</label>
                            <input class="form-control" type="text" name="phone" placeholder="Enter Phone" />
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input class="form-control" type="text" name="subject" placeholder="Enter Phone" />
                        </div>
                        <div class="form group">
                            <label for="subject" class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="8"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0">Submit</button>
                    </form>
      			    <div>
				    <h2>Company Information:</h2>
						<p>City: Hays</p>
						<p>State: Kansas</p>
						<p>USA</p>
				   		<p>Phone:000-000-0000</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>ecommercecsci675@gmail.com</span></p>
			     </div>   	
         </div>
    </div>
</div>
</div>

<?php
include("inc/footer.php"); 
?>