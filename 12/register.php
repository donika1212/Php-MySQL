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

        if(empty($name) || empty($surnaem)  || empty($username)  || empty($email) || empty($password))
        {
            echo "you need to fill all the fileds";
        }

        else{

            $sql = "SELECT username FROM users WHERE username=:username";

            $tempSql = $conn->prepare($sql);

            $tempSql->binsParam(':username', $username);

            $tempSql->execute();

            if(($tempSql->rowCount() > 0)) {
                echo "username exist!";
                header("refresh:2; url=signup.com");
            }

        else {
            $sql = "INSERT INTO users(username,name,surname,password,email) VALUES (:username, :name, :surname, :password, :email)";


            $insertSql = $conn->prepare($sql);


            $insertSql->bindParam(':name', $name);
            $insertSql->bindParam(':surname', $surname);
            $insertSql->bindParam(':username', $username);
            $insertSql->bindParam(':password', $password);
            $insertSql->bindParam(':email', $email);


            $insertSql->execute();

            echo "data saved successfully";
            header("refresh:2; url=login.php");

        }
    }
    }






?>