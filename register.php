<?php

include_once('config.php');

if(isset($_POST["submit"])){
    $emri = $_POST["emri"];
    $lastname = $_POST["lastname"];
    $email = $_Post["email"];

    $tempPass = $_POST["password"];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);


    $tempConfirm = $_POST["password"];
    $password = password_hash($tempConfirm, PASSWORD_DEFAULT);
    

    if(empty($emri)) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)
    {
        echo"you have nit filles all the fields";
    }
}
else{
    $sql = "INSERT INTO users(emri,username,email,password,confirm_password) VALUES (:emri,:lastname, :email, :password, :confirm_password)";

    $insertSql = $conn->prepare($sql);

    $insertSql->bindParam(":emri",$emri);
    $insertSql->bindParam(":lastname",$username);
    $insertSql->bindParam(":email",$email);
    $insertSql->bindParam(":password",$password);
    $insertSql->bindParam(":confirm_password",$confirm_password);

    $insertSql->execute();
    header("Location:index.php");
}