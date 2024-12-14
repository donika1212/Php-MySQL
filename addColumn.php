<?php

try{

$pdo = new PDO("mysql:host=localhost;dbname=database12","root","");

$sql = "ALTER TABLE products ADD email VARCHAR(255)";

$pdo -> exec($sql);

echo"Column created succesfully";
}catch(PDOException $e){
    echo"Error creating columns:" .$e ->getMessage();
}

?>