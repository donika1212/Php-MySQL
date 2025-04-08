<?php
include_once('config.php');

$username = "admin";
$password = "admin123";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();

echo "User added successfully!";
?>