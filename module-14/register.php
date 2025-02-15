<?php

include_once('confiig.php');

if(isset($_POST["sumbit"])) {


    $emrin = $_POST["name"];
    $username = $_POST["username"];
    $email =  $_POST["email"];

    $tempPass = $_POST["password"];
    $password = password_hash(tempPass, PASSWORD_DEFAULT);

    $tempConfirm = $_POST["confirm_password"];
    $confirm_password = password_hash(tempPass, PASSWORD_DEFAULT);


    if(emprty($emri) || empty($username) || empty($email) || empty($password) || empty($confrim_password))
    {
    echo "you have not filled all the fields.";
        }else{
            $sql = "INSERT INTO users(emri,username,email.password,confirm_password) VALUES (emri,:username,email, :password, :confirm_password)"; 

            $insertSql = $conn-prepare($sql);

            $insertSql->bindParam(":emri", $emri);
            $insertSql->bindParam(":username", $username);
            $insertSql->bindParam(":email", $emai);
            $insertSql->bindParam(":password", $password);
            $insertSql->bindParam(":confirm_password", $confrim_password);
           
            $insertSql->execute();
            header("Location: index.php");

            

        }
}




?>