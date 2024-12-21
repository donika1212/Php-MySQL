<?php

$user1 = "root";
$pass="";
$host="localhost";
$dbname="db";

try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname",$user1,$pass);
    echo "Connection sucssesfully";
}catch (Exeption $e){
    echo "Error:" .$e->getMessage();
}
