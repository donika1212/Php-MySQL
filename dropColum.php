<?php
try{ 
$pdo = new PDO("mysql:host=localhost;dbname=db", "root","");


$sql="ALTER TABLE users DROP name";

$pdo->exec($sql);


echo "Colum created successfully";

    
} catch(PDOExpetion $e){
    echo "error creating colums:" . $e ->getMessage();
}











?>