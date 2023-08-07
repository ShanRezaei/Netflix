<!-- we will make a class here to register the user -->
<?php

// acount class
class Account{

    // properties
    private $con;
    private $errorArray=array();

    //constructor
    public function __construct($con)
    {
        $this->con=$con;
    }


    // we will do all validations here throughout register function
    public function register($fn,$ln,$un,$em,$em2,$pw,$pw2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmail($em,$em2);
        $this->validatePassword($pw,$pw2);

        if(empty($this->errorArray)){
            return $this->InsertData($fn,$ln,$un,$em,$pw);

        }

        return false;

    }

    public function logInUser($un,$pw){
         // hash the password
         $pw=hash("sha512" ,$pw);
         $query=$this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
         
         $query->bindValue(":un", $un);
         $query->bindValue(":pw", $pw);
 
         // if we have error inserting data, to find the error
         // we could use var_dump($query->errorInfo());
         // and change return $query->execute() to return false.
 
         $query->execute();

         if($query->rowCount()==1){
            return true;
         }

         array_push($this->errorArray,Constants::$loginErr);
         return false;


    }

    // insert data in users table
    private function InsertData($fn,$ln,$un,$em,$pw){

        // hash the password
        $pw=hash("sha512" ,$pw);
        $query=$this->con->prepare("INSERT INTO users (firstName, lastName,username,email,password) VALUES (:fn,:ln,:un,:em,:pw)");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        // if we have error inserting data, to find the error
        // we could use var_dump($query->errorInfo());
        // and change return $query->execute() to return false.

        return $query->execute();

    }




    //function to validate
    // we make the private function for privacy and we no longer access to this methods from outside the class.
    // we can use this methods just here and inside the class. we made register function and used this private methods inside it.
    private function validateFirstName($fn){

        if(strlen($fn)<2 || strlen($fn)>25){

            array_push($this->errorArray,Constants::$firstNameCharacter);

        }
    }

    private function validateLastName($ln){

        if(strlen($ln)<2 || strlen($ln)>25){

            array_push($this->errorArray,Constants::$lastNameCharacter);

        }
    }


    private function validateUsername($un){

        // validate for character numbers
        if(strlen($un)<2 || strlen($un)>25){

            array_push($this->errorArray,Constants::$usernameCharacter);

            // when we add return here, if we have this error for username it will not go for the next one to check
            // it means if the username is less than 2 or more than 25, it will not go to check the unique username.
            return;

        }


        // validate for unique username
        $query=$this->con->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un",$un);

        $query->execute();
        if($query->rowCount() != 0){
            array_push($this->errorArray,Constants::$usernameTaken);

        }


    }

    private function validateEmail($em,$em2){
        // to check if em and em2 are the same
        if($em != $em2){
            array_push($this->errorArray,Constants::$emailDontMatch);
            return;

        }

        // check the patter of the email
        if(! filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,Constants::$emailInvalid);
            return;

        }

        // check for unique email
        $query=$this->con->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindValue(":em",$em);

        $query->execute();
        if($query->rowCount() != 0){
            array_push($this->errorArray,Constants::$emailTaken);

        }
        

    }


    private function validatePassword($pw,$pw2){
        // to check if pw and pw2 are the same
        if($pw != $pw2){
            array_push($this->errorArray,Constants::$passwordDontMatch);
            

        }


    }


    // function to get error to echo it
    public function getError($error){
        if(in_array($error,$this->errorArray)){
            //to style the error message, instead of echoing them in span in register page, here
            // we will return html tag
            return "<span class='errorMessage'>$error</span>";
        }

    }


}

?>