<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="index_Get.php" method="get">

    <label for="username">Username:</label>
    <input type="text" name="username" placeholder="Username"><br>
    <label for="username">Password:</label>
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