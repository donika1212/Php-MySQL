<?php


try{
$pdo = new PDO("mysql:host=localhost;dbname=mydb", "root","");


$sql ="ALTER TABLE products ADD email VARCHAR(255)";

$pdo->exec($sql);

echo"colume created succses";

} catch(PDOExeption $e){

    echo "Eroor creating columns:" . $e ->getMessage();
    
}


?>