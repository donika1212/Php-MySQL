<?php

$user = "root";
$pass = "";
$host = "localhost";
$dbname = "database1";

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    echo"Connection succesfully";
} catch(exception $e) {
    echo"Error:" .$e ->getMessage();
}


?>