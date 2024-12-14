<?php

try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");

$sql = "ALTER TABLE products DROP email";

$pdo->exec($sql);

echo "column removed successfully";

}catch(PDOExeption $e){

    echo "error creating columns:" . $e ->getMessage();
}










?>