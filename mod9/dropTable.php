<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb","root","");

$sql ="DROP TABLE users ";

$pdo->exec($sql);

echo"Table dropped succssefuly";


} catch(PDOExeption $e){

    echo"Error creating columns:" . $e ->getMessage();
}

?>