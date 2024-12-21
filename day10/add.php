<?php

include_once("config.php");


if(isset($_POST["submit"])){

$name=$_POST["Name"];
$surname = $_POST["surname"]
$surname = $_POST["email"]



$sql = "insert into user(name,surname,email) values(:name,:surname:email)";


$sql = $conn->prepare($Sql);

$sql->bindParam(":name"$name);
$sql->bindParam(":surname"$surname);
$sql->bindParam(":email"$email);


$sqlQUery->execute();

echo"Data saves successfully ...";







}







?>