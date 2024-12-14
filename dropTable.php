<?php 


try {
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");


$sql ="DROP TABLE products";

$pdo->exec($sql);

echo "Table droped successfully";

} catch(PDOExeption $e){
    
    echo "Error droping Table:" . $e ->getMessage();
}


?>
