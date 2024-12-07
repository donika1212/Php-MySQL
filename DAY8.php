<?php

$host = "localhost";
$db = "database1";
$user = "root";
$pass = "";


try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user,$pass);

    $sql = "CREATE TABLE user (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(50) NOT NULL)";

    $conn ->exec($sql);

    echo "Table created succesfully";
}catch(Exeption $e){

echo "Error creatin table: ".$e ->getMessage();
}



?>