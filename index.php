<?php

$host = "localhost";
$user = "root";
$pass = "";

try {
    $conn = new PDO ("mysql:host=$host",$user,$pass);

    $sql = "Create DATABASE database1";

    $conn -> exec($sql);

    echo "Database is created";

}catch(Exeption $e) {
    echo "Database is not created";
}










?>