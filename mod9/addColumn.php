<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb","root","");

$sql ="ALTER TABLE users ADD email1 VARCHAR(255)";

$pdo->exec($sql);

echo"Colum created succssefuly";


} catch(PDOExeption $e){

    echo"Error creating columns:" . $e ->getMessage();
}

?>