<?php
ob_start();//turn on output buffering
session_start();
//set time zone
date_default_timezone_set("America/Montreal");

//make connection with database
try{
    $con=new PDO("mysql:dbname=netflix;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    
}catch(PDOException $e){
    
    exit("connection failed" . $e->getMessage());

}

?>