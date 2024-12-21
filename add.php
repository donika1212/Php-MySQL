<?php

include_once("config.php");

if(isset($_POST["submit"])) {

$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];

$sql = "insert into user1(name,surname,email) values(:name,:surname,:email)";

$sqlQuery = $conn -> prepare($sql);
$sqlQuery -> bindParam(":name",$name);
$sqlQuery -> bindParam(":surname",$surname);
$sqlQuery -> bindParam(":email",$email);

$sqlQuery->execute();

echo "Data saves successfully...";


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="add.php" method = "POST">
        <input type = "text" name = "name" placeholder = "Name"><br>
        <input type = "text" name = "surname" placeholder = "Surname"><br>
        <input type = "text" name = "email" placeholder = "Email"><br>
        <button type = "submit" name = "submit">Add</button>
    </form>
</body>
</html>