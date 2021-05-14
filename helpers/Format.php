<?php

class Format{

    /**
     * This method takes a date and 
     * formats the date using the date
     * built in function in php, month, day, year,
     * current time
     */
    public function formatDate($date){

        return date('F j,Y,g:i a', strtotime($date));
    }

    /**
     * Method to shorten text
     * Text passed and characters
     * to be display in this aray
     */
    public function textShorten($text, $limit = 400){
	//blank text
    $text = $text. "";
    //substring from 0-400 characters visible
	$text = substr($text, 0, $limit);
    //concatenate to show additional text
	$text = $text."..";
    //return the text
	return $text;
    }

    /**
     * This function takes any data as input
     * and passes the input to several built in functions 
     * to fix the user input. The data is then 
     * returned upon running all validation on 
     * it
     */
    public function validation($data){
        //trims any white space from data
        $data = trim($data); 
        //removes backslashes
        $data = stripcslashes($data); 
        //converts special characters to normal 
        $data = htmlspecialchars($data); 
        //return the formatted data
        return $data; 
    }
}


?>