<?php


try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb","root","");


$sql ="ALTER TABLE products DROP email ";

$pdo->exec($sql);

echo"Column droped successfully";


} catch(PDOExeption $e){

    echo "Error droping tables:" . $e ->getMEssaage();
}






?>