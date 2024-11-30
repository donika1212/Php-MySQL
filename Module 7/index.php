<?php

$host = "localhost";
$user = "root";
$pass = "";

try{

    $conn = new PDO ("mysql:host=$host" , $user,$pass);

    $sql = "CREATE DATABASE database12";

    $conn -> exec($sql);


    echo "Database is created";



}catch(Exeption $e){
    echo "Database is not created";


}















?>