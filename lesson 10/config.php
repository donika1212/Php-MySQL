<?php
$user = "root";
$pass=""
$host="localhost"
$dbname"mydb";


try(
    $conn new PDO("mysql:host=$host;mydb=$dbname",$user,$pass);
    echo "Connection sucssefully";

)catch (Exeption $e)(
    echo"Error" .$e->getMessage();
)







?>