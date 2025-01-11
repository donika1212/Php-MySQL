<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";


$conn = new mysqli($localhost, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>