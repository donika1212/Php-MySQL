<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");

$sql = "DROP TABLE products";

$pdo->exec($sql);

echo "table removed successfully";

}catch(PDOExeption $e){

    echo "error creating columns:" . $e ->getMessage();
}










?>