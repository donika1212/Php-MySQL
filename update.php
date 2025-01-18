<?php
include_once("config.php");

if(isset($_POST['update'])){

    $id = $_GET['id'];
    $name = $_GET['name'];
    $lastname=$_GET['surname'];

    $sql = "UPDATE mytable SET name=name, surname:surname WHERE id=:id";

    $prep = $conn->prepare($sql);

    $prep->bindParam(':id',$id);
    $prep->bindParam(':name',$name);
    $prep->bindParam(':lastname',$lastname);
    
    $prep->execute();

    header('Location:dashboard.php');
    

}

?>