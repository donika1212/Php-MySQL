<?php

include_once('config.php');

   if(isset($_POST['submit']))
   {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $tempPass = $_POST['password'];
    $email = $_POST['email'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    if(empty($name) || empty($surname) || empty($username) || empty($email) || empty($email) || empty($password) )
    {
        echo "You need to fill all the fields";
    }
    else{

        $sql = "SELECT username FROM users WHERE username=:username";

        $tempSql = $conn->prepare($sql);
        
        $tempSql->bindParam(':username', $username);

        $tempSql->execute();

        if(($tempSql->rowcount() > 0)) {
            echo "Username exist!";
            header("refresh:2; url=singup.com");
        }
        else {
            $sql = "INSERT INTO users(username,name,surname,password,email) VALUES (:username, :name, :surname, :password, :email)";


            $insertSql = $conn->prepare($sql);


            $insertSql->bindParam(':username', $username);
            $insertSql->bindParam(':name', $name);
            $insertSql->bindParam(':surname', $surname);
            $insertSql->bindParam(':password', $password);
            $insertSql->bindParam(':email', $email);


            $insertSql->execute();
             echo "Data saved successfully";
             header("refresh:2; url=login.php");
        }
    }
   }