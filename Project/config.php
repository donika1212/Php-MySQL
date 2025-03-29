<?php
$host = "localhost";  // Change if needed
$dbname = "food-order1";  // Replace with your actual database name
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
