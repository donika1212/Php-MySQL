<?php

try{

$pdo = new PDO("mysql:host=localhost;dbname=database12","root","");

$sql = "ALTER TABLE products DROP name";

$pdo -> exec($sql);

echo "Column dropped succesfully";
} catch(PDOException $e){

    echo"Error creating columns:" .$e ->getMessage();
}

?>