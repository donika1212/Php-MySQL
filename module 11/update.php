<?php

include_once("config.php");

if(isset($_POST['update'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $lastname = $_POST['lastname'];

    $sql = "UPDATE mytable SET username=:username, lastname:lastname WHERE id=:id";

    $prep = $conn->prepare($sql);

    $prep->bindParam(':id', $id);
    $prep->bindParam(':username', $username);
    $prep->bindParam(':lastname', $lastname);

    $prep->execute();

    header('Location:dashboard.php');

}
?>