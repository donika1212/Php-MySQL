<?php




try{
    $pdo = new PDO("mysql:host=localhost;dbname=database1","root","");
    
    $sql = "ALTER TABLE products DROP email";

    
    $pdo ->exec($sql);
    
    echo "Column dropped succesfully";
    
    }catch(PDOExeption $e){
        echo "Error creating columns:" . $e ->getMessage();
    }




?>