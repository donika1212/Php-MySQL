<?php
try{ 
$pdo = new PDO("mysql:host=localhost;dbname=db", "root","");


$sql="DROP TABLE users";

$pdo->exec($sql);


echo "Table created successfully";

    
} catch(PDOExpetion $e){
    echo "error creating colums:" . $e ->getMessage();
}











?>