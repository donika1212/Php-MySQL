<?php


try{
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");

$sql = "ALTER TABLE products ADD email VARCHAR(255)";

$pdo->exec($sql);

echo "column created successfully";

}catch(PDOExeption $e){

    echo "error creating columns:" . $e ->getMessage();
}












?>