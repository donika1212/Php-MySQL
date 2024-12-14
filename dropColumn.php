<?php 


try {
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "root","");


$sql ="ALTER TABLE category DROP name";

$pdo->exes($sql);

echo "Column droped successfully";

} catch(PDOExeption $e){
    
    echo "Error droping columns:" . $e ->getMessage();
}


?>
