<?php
// include db connection
require_once("includes/config.php");
// we should include our form sanitizer here to use
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
// add account
require_once("includes/classes/Account.php");

// INSTANTIATE ACCOUNT and give it input $con for connection to database
$account=new Account($con);


if(isset($_POST['submitButton'])){
    unset($_POST['submitButton']);

    // our method is static so we could have access without any instantiation
   
    $username=FormSanitizer::sanitizeFormUsername($_POST['username']);
    $password=FormSanitizer::sanitizeFormPassword($_POST['password']);


    $success=$account->logInUser($username,$password);

    if($success==true){

        // set session
        $_SESSION["userLoggedIn"]=$username;
        header("Location:index.php");

    }

    


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- bootstrap link *****************but in real production it is better to download the file and have it in our machine to reference it***-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
     <!-- link to style -->

    <link href="style/style.css" rel="stylesheet" type="text/css" />

  
    <title>Netflix</title>
</head>
<body>

<div class="signInContainer">
    <div class="column">
        <!-- header -->
        <div class="header">
            <img src="images/mylogo.png" alt="logo" >
            <h3>Sign in</h3>
            <span>To Continue to Netflix</span>

        </div>



        <!-- add form for registration -->
        <form method="POST">

            
            <input type="text" name="username" id="" placeholder="Username" required>
            
            <input type="password" name="password" id="" placeholder="Password" required>
            <?php echo $account->getError(Constants::$loginErr) ?>
           
            <input type="submit" name="submitButton" value="Sign in" class="btn btn-primary">


        </form>

        <a href="register.php" class="signInMessage">Need an account? Sign up here .</a>

    </div>


</div>
   







    












<!-- link to bootstrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- link to jquery -->
<script src="jsFolder/jquery.js"></script>

<!-- link to costume javascript -->
<script  src="jsFolder/app.js" type="text/javascript"></script>
</body>
</html>