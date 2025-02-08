<?php

include_once('config.php');

   if(isset($_POST['submit']))
   {

       
    $surname = $_POST['title'];
    $username = $_POST['description'];
    $tempPass = $_POST['quantity'];
    $email = $_POST['price'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    if(empty($title) || empty($description) || empty($quantity) || empty($price))
    {
        echo "You need to fill all the fields";
    }
    else{

        $sql = "SELECT title FROM products WHERE title=:title";

        $tempSql = $conn->prepare($sql);
        
        $tempSql->bindParam(':title', $title);

        $tempSql->execute();

        if(($tempSql->rowcount() > 0)) {
            echo "Product exist!";
            header("refresh:2; url=addProduct.php");
        }
        else {
            $sql = "INSERT INTO products(title,id,description,price,quantity) VALUES (:title, :id, :description, :price, :quantity)";


            $insertSql = $conn->prepare($sql);


            $insertSql->bindParam(':id', $id);
            $insertSql->bindParam(':title', $title);
            $insertSql->bindParam(':description', $description);
            $insertSql->bindParam(':price', $price);
            $insertSql->bindParam(':quantity', $quantity);


            $insertSql->execute();
             echo "Data saved successfully";
             header("refresh:2; url=login.php");
        }
    }
   }