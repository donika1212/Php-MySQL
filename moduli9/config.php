<?php

$user ="root";
$pass ="";
$host ="localhost";
$dbname ="db";

try {
    $conn= new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
} catch(Exeption $e) {
    echo "Error:" .$e->getMessage();

}




?>