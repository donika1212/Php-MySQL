<?php

$user = "root";
$pass = "";
$host = "localhost";
$dbname = "test";

try {
$conn = new PDO ("mysql:host=$host;dbname=$dbname",$user,$pass);

}catch (Exeption $e) {
    echo "error:" .$e->getMessage();


}





?>