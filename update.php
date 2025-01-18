<?php

include_once("config.php");

if(isset($_POST['update'])) {
    $id = $_GET['id'];
    $username = $_GET['username'];
    $lastname = $_GET['lastnamee'];


    $sql = "UPDATE mytable SET username=:username, lastname=:lastname WHERE id=:id";

    $prep = $conn->prepare($sql);

    $prep->bindParam(':id', $id);
    $prep->bindParam(':username', $username);
    $prep->bindParam(':lastname', $lastname);

    $prep->execute();

    header('Location:dashboard.php');


}


?>