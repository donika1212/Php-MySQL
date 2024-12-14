<?php
try{ 
$pdo = new PDO("mysql:host=localhost;dbname=db", "root","");


$sql="ALTER TABLE users ADD email12 VARCHAR(255)";

$pdo->exec($sql);


echo "Colum created successfully";

    
} catch(PDOExpetion $e){
    echo "error creating colums:" . $e ->getMessage();
}











?>