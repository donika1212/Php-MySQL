<?php


include_once('config.php');

if(isset($_POST["Submit"])) {

    $emri = $_POST["name"]
    $lastname= $_POST["lastname"];
    $email= $_POST ["email"]


    $stemPass = $_POST["password"];
    $password = password_hash($stemPass, PASSWORD_DEFAULT);
     

    $tempConfirm = $_POST["password"];
    $password = password_hash($tempConfirm, PASSWORD_DEFAULT);


    if(empty($emri) || emtpy($username) || emtpy($email) || emtpy($password) || emtpy($confirm_password))
    {
        echo "You have nit filles all the fileds.";
    }
    else{
        $sql = "INSERT INTO users (emri,username,email,password,confirm_password) VALUES (:emri,username, :email, :password, :confirm_password)";

        $inseertSql = $conn ->prepare($sql);
        

        $inseertSql->bindParam("emri", $emri);
        $inseertSql->bindParam("username", $username);
        $inseertSql->bindParam("email", $email);
        $inseertSql->bindParam("password", $password);
        $inseertSql->bindParam("confirm_password", $confirm_password);


        $insertSql->execute();
        header("location: index.php");
    }
}
