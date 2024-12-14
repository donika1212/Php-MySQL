<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="index_GET.php" method="get">

<label for="username">Username:</label><br>
<input type="text" name="username" placeholder="Username"><br>
<label for="password">Password:</label><br>
<input type="password" name="password" placeholder="Password"><br><br>
<input type="submit" vaule="Submit"><br><br>

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