<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="index_Get.php" method="get">

<label for="username">Username:</label><br>
<input type="text" name="username" placeholder="Username"><br><br>
<label for="password">Password</label><br>
<input type="password" name="password" placeholder="Password"><br><br>
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