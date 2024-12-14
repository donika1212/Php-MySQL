<?php

try{

$pdo = new PDO("mysql:host=localhost;dbname=database12","root","");

$sql = "DROP TABLE products";

$pdo -> exec($sql);

echo "Table dropped succesfully";
} catch(PDOException $e){

    echo"Error creating columns:" .$e ->getMessage();
}

?>