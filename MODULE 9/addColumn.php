<?php


try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb","root","");


$sql ="ALTER TABLE category ADD email VARCHAR(255)";

$pdo->exec($sql);

echo"Column created successfully";


} catch(PDOExeption $e){

    echo "Error creating tables:" . $e ->getMEssaage();
}






?>