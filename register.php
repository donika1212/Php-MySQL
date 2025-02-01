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

    IF(empty($name) || empty($surname) || empty($username) || empty($email) || empty($password))
{
    echo "you need to fill all the fields";

}
else{
    $sql = "SELECT username FROM user2 WHERE username=:username";
    $tempSql = $conn->prepare($sql);
    $tempSql->bindParam(':username', $username);
    $tempSql->execute();

    if(($tempSql->rowCount() > 0)){
        echo "Username exist!";
        header("refresh:@; url=signup.com");
    }
else{
    $sql = "INSERT INTO user2 (name,surname,username,email,password) VALUES (:name, :surname,:username,:email,:password)";
    
    $insertSql = $conn->prepare($sql);

    $insertSql->bindParam(':name',$name);
    $insertSql->bindParam(':surname',$surname);
    $insertSql->bindParam(':username',$username);
    $insertSql->bindParam(':password',$passsword);
    $insertSql->bindParam(':email',$email);

    $insertSql->execute();

    echo "Data saved succesfully";
    header("refresh:2; url=login.php");

    
}

}}