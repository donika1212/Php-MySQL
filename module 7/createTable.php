<?php

$host= "localhost";
$db = "db";
$user = "root";
$pass = "";

try {

    $connection =new PDO("mysql:host=$host;dbname=$db", $user,$pass);

    $sql = "CREATE TABLE user (id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         username VARCHAR(30) NOT NULL,
                         password VARCHAR(50) NOT NULL )";

    $connection ->exec($sql);
    
    echo "Table created successfully";


}catch (Exeption $e) {
    
    echo "Error creating table:" . $e ->getMessage();
}



?>