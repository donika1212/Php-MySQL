<?php




try{
    $pdo = new PDO("mysql:host=localhost;dbname=database1","root","");
    
    $sql = "DROP TABLE products";

    
    $pdo ->exec($sql);
    
    echo "Table dropped succesfully";
    
    }catch(PDOExeption $e){
        echo "Error creating columns:" . $e ->getMessage();
    }




?>