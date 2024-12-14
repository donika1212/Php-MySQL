<?php 
try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");

$sql ="DROP TABLE users";

$pdo->exec($sql);

echo "table dropped successfully";
} catch(PDOExeption $e){
    echo "Error droping table:" . $e ->getMessage();
}
