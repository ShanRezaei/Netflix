<!-- to make the error messages it is better to use the constants to prevent any error -->
<!-- it means whenever we want to change any error message content we just need to come here in this class as change it just here -->
<!-- so all our error messages should be declared here -->
<?php
class Constants{
    public static $firstNameCharacter="Your first name should be between 2 and 25 character.";
    public static $lastNameCharacter="Your last name should be between 2 and 25 character.";
    public static $usernameCharacter="Your last name should be between 2 and 25 character.";
    public static $usernameTaken="This user name is already taken.";
    public static $emailDontMatch="Your emails do not match.";
    public static $emailInvalid="Your email is invalid.";
    public static $emailTaken="This email is already in use.";
    public static $passwordDontMatch="Your passwords do not match.";
    public static $loginErr="Either your username or password is wrong.";



}
?>