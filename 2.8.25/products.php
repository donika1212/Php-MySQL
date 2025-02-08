<?php
include_once('config.php');
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        if(empty($title) || empty($description) || empty($quantity) || empty($price))
        {
            echo "You need to fill all the fields";
        }
        else{
            $sql = "SELECT title FROM products WHERE title=:title";
            $tempSql = $conn->prepare($sql);
            $tempSql->bindParam(':title', $title);
            $tempSql->execute();
            if(($tempSql->rowCount() > 0)){
                echo "Product title already exists!";
                header("refresh:2; url=product_page.php");
            }
            else{
                $sql = "INSERT INTO products(title, description, quantity, price) VALUES (:title, :description, :quantity, :price)";
                $insertSql = $conn->prepare($sql);
    
                $insertSql->bindParam(':title', $title);
                $insertSql->bindParam(':description', $description);
                $insertSql->bindParam(':quantity', $quantity);
                $insertSql->bindParam(':price', $price);
    
                $insertSql->execute();
                echo "Product saved successfully";
                header("refresh:2; url=product_page.php");
            }
        }
    }
?>
