<?php  


try{
$pdo = new PDO("mysql:host=localhost;dbname=database1","root","");

$sql = "ALTER TABLE products ADD email VARCHAR(255)";

$pdo ->exec($sql);

echo "Column created succesfully";

}catch(PDOExeption $e){
    echo "Error creating columns:" . $e ->getMessage();
}





?>