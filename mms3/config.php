<?php

$user= "root";
$pass = "";
$server = "localhost";
$dbname ="mms";

try{
    
    $conn = new Pdo("mysql:host=$server; dbname=$dbname" , $user , $pass);

}catch(PDOExeption $e){

    echo "error:" . $e->getMessage();
}

?>