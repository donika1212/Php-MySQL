<?php

include_once('config.php');

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $password = password_hash($tempPass,PASSWORD_DEFAULT);

        if(empty($id) || empty($title) || empty($description) || empty($quantity) || empty($price))
        {
            echo "You need to fill all the fileds";
        }
        else{
            $sql = "SELECT username FROM user2 WHERE username=:username";

            $tempSql = $conn->prepare($sql);

            $tempSql->bindParam(':title',$title);

            $tempSql->execute();

            if(($tempSql->rowCount() > 0)){
                echo "Username exist!";
                header("refresh:2; url=singup.com");
            }
            else{
                $sql = "INSERT INTO user1(id,title,description,quantity,price) VALUES (:id, :title, :description, :quantity, :price)";


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





?>