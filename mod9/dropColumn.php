<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb","root","");

$sql ="ALTER TABLE users DROP email1";

$pdo->exec($sql);

echo"Colum dropped succssefuly";


} catch(PDOExeption $e){

    echo"Error creating columns:" . $e ->getMessage();
}

?>