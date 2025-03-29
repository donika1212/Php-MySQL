<?php

$user= "root";
$pass = "";
$server = "localhost";
$dbname= "projekt";

try{

    $conn = new PDO("mysql:host=$server; dbname=$dbname" , $user , $pass);


}catch(PDOExpetion $e){

    echo "Error:" . $e->getMessage();

}










?>