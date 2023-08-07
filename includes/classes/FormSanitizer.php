<!-- this is the class for sanitizing inputs as an string -->
<?php
class FormSanitizer{

    // the function for strings
    public static function sanitizeFormString($inputText){
        // delete any html tags inside the input 
        // this is for security reasons
        $inputText=strip_tags($inputText);
        // delete any space
        $inputText=str_replace(" ","",$inputText);
        // make the first letter uppercase
        $inputText=strtolower($inputText);
        $inputText=ucfirst($inputText);
        return $inputText;


    }

    // for username
    public static function sanitizeFormUsername($inputText){
        // delete any html tags inside the input 
        // this is for security reasons
        $inputText=strip_tags($inputText);
        // delete any space
        $inputText=str_replace(" ","",$inputText);
        
        return $inputText;


    }

    // for password
    public static function sanitizeFormPassword($inputText){
        // delete any html tags inside the input 
        // this is for security reasons
        $inputText=strip_tags($inputText);
        
        return $inputText;


    }
    // for email
    public static function sanitizeFormEmail($inputText){
        // delete any html tags inside the input 
        // this is for security reasons
        $inputText=strip_tags($inputText);
        // delete any space
        $inputText=str_replace(" ","",$inputText);
       
        return $inputText;


    }


}



?>