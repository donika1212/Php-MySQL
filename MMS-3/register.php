<?php

include_once('config.php');

if(isset($_POST["submit"])) {


$emri = $_POST["emri"];
$username = $_POST["username"];
$email = $_POST["email"];

$tempPass = $_POST["password"];
$password = password_hash($tempPass, PASSWORD_DEFAULT);


$tempConfirm = $_POST["confirm_password"];
$confirm_password = password_hash($tempConfirm, PASSWORD_DEFAULT);


if (empty($emri) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password) ){
    echo "You have not filles all the fileds.";
}else{
    $sql = "INSERT INTO users1(emri,username,email,password,confirm_password) VALUES (:emri,:lastname, :email, :password, :confirm_password)";

    $insertSql = $conn->perpare($sql);

    $insertSql->bindParam(":emri",$emri);
    $insertSql->bindParam(":username",$username);
    $insertSql->bindParam(":email",$email);
    $insertSql->bindParam(":password",$password);
    $insertSql->bindParam(":confirm_password",$confirm_password);

    $insertSql->execute();
    header("Location: index.php");
}







}






?>