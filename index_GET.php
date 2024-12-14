<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="index_GET.php" method="get">

<label for="username">Username:</label>
<input type="text" name="username"placeholder="username"><br>
<label for="password">Password:</label><br>
<input type="password" name="password" placeholder="password"><br><br>
<input type="submit" value="submit"><br><br>

</form>



<?php


$username = $_GET["username"];
$password = $_GET["password"];


echo $username;

echo "<br>";

echo $password;


?>
    
</body>
</html>