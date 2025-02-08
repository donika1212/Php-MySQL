<?php


include_once('config.php');


if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $username = $_POST['title'];
    $name = $_POST['description'];
    $surname = $_POST['quantity'];
    $email = $_POST['price'];


    $sql = "UPDATE users SET title=:title, description=:description, quantity=:quantity, price=:price WHERE id=:id";
    $prep = $conn->prepare($sql);
    $prep->bindParam(':id', $id);
    $prep->bindParam(':title', $title);
    $prep->bindParam(':description', $descriotion);
    $prep->bindParam(':quantity', $quantity);
    $prep->bindParam(':price', $price);


    $prep->execute();


    header("Location:dashboard.php");
}



?>