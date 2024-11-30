<?php

$host = "localhost";
$user = "root";
$pass = " ";

try {
    $conn = new PDO("mysql:host=$host", $user,$pass);
    $sql = " CREATE DATABASE database13";
    $conn -> exec($sql);
     echo "database created";

}catch (Exeption $e){ 
    echo " database is not created";
}

?>