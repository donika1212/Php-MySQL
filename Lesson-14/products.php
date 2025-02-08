<?php

include_once('config.php');

    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if( empty($title) || empty($description) || empty($quantity) || empty($price))
        {
            echo "You need to fill all the fileds";
        }
        else{
            $sql = "SELECT title FROM products WHERE title=:title";

            $tempSql = $conn->prepare($sql);

            $tempSql->bindParam(':title',$title);

            $tempSql->execute();

            if(($tempSql->rowCount() > 0)){
                echo "Username exist!";
                header("refresh:2; url=addProduct.php");
            }
            else{
                $sql = "INSERT INTO products(title,id,description,quantity,price) VALUES (:title, :id, :description, :quantity, :price)";


                $insertSql = $conn->prepare($sql);
    
    
                $insertSql->bindParam(':id', $id);
                $insertSql->bindParam(':title', $title);
                $insertSql->bindParam(':description', $description);
                $insertSql->bindParam(':quantity', $quantity);
                $insertSql->bindParam(':price', $price);
    
    
                $insertSql->execute();

                echo "Data saved successfully";
                header ("refresh:2; url=login.php");
    
            }
        }
    }

