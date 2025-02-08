<?php

include_once('config.php');

    if(isset($_POST['submit']))
    {
        $name = $_POST['title'];
        $surname = $_POST['description'];
        $username = $_POST['quantity'];
        $tempPass = $_POST['price'];
        
       

        if ( empty($title) || empty($description) || empty($quantity) || empty($price))
        {
            echo "You need to fill all the fileds";
        }
        else{
            $sql = "SELECT title FROM products WHERE title=:title";

            $tempSql = $conn->prepare($sql);

            $tempSql->bindParam(':title',$title);

            $tempSql->execute();

            if(($tempSql->rowCount() > 0)){
                echo "title exist!";
                header("refresh:2; url=addproduct.com");
            }
            else{
                $sql = "INSERT INTO products(title,description,quantity,price) VALUES (:title,description,quantity,price)";


                $insertSql = $conn->prepare($sql);
    
    
                
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





?>