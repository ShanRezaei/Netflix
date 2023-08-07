<?php
// include db connection
require_once("includes/config.php");
require_once("includes/classes/CategoryContainers.php");
require_once("includes/classes/previewProvider.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/entityProvider.php");
require_once("includes/classes/SeasonProvider.php");
require_once("includes/classes/Season.php");
require_once("includes/classes/Video.php");



$preview=new PreviewProvider($con,$_SESSION["userLoggedIn"]);


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

<?php

//get the id of url
if(!isset($_GET['id'])){
    // by using exit, the codes after it wont be executed.
    exit("no id");

}
$entityId=$_GET['id'];
$entity=new Entity($con,$entityId);

echo $preview->createPreviewVideo($entity);


?>

<div class="wrapper">
    <!-- to show the seasons of the selected movie -->
    <?php
    $seasonProvider=new SeasonProvider($con,$_SESSION["userLoggedIn"]);
    $seasonProvider->create($entity);
    ?>


</div>




    



<!-- link to bootstrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<!-- link to jquery -->
<script src="jsFolder/jquery.js"></script>

<!-- link to font awesome -->
<script src="https://kit.fontawesome.com/06a651c8da.js"  crossorigin="anonymous"></script>

<!-- link to costume javascript -->
<script  src="jsFolder/app.js" type="text/javascript"></script>
</body>
</html>