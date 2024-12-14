<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
   <form action="index_GET.php" method="get">

   <label for="username">username:</label><br>
   <input type="text" name="username" placeholder="username"><br>
   <label for="Password">Password:</label><br>
   <input type="Password" name="Password" placeholder="Password"><br><br>
   <input type="submit" value="submit">




   </form>
    <?php

  $username = $_GET["username"];
  $Password = $_GET["Password"];


   echo $username;

   echo "<br>";

   echo $Password





?>



</body>
</html>