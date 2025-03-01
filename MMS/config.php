<?php

$user= "root";
$pass = "";
$server = "localhost";
$dbname= "mms";

try{

    $conn = new PDO("mysql:host=$server; dbname=$dbname" , $user , $pass);


}catch(PDOExpetion $e){

    echo "Error:" . $e->getMessage();

}










?>