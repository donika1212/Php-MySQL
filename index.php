<?php 
try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");

$sql ="ALTER TABLE users ADD number VARCHAR(255)";

$pdo->exec($sql);

echo "column created successfully";
} catch(PDOExeption $e){
    echo "Error creating columns:" . $e ->getMessage();
}




?>