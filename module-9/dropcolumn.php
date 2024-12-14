<?php


try{
$pdo = new PDO("mysql:host=localhost;dbname=mydb", "root","");


$sql ="DROP TABLE products";

$pdo->exec($sql);

echo"colume created succses";

} catch(PDOExeption $e){

    echo "Eroor creating columns:" . $e ->getMessage();
    
}


?>