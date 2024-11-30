<?php

$host = "localhost";
$user = "root";
$pass = "";

try {

    $conn = new PDO ("mysql:host=$host", $user, $pass);

    $sql = "CREATE DATABASE database1";

    $conn ->exec($sql);

    echo "database is created";

}catch (Exeption $e) {
    echo "NOT CONNECTED";

}







?>