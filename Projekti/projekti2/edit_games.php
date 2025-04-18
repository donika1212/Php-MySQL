<?php

include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $developer = $_POST['developer'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    
    $stmt = $pdo->prepare("UPDATE games SET name=?, developer=?, release_year=?, genre=?, price=? WHERE id=?");
    $stmt->execute([$name, $developer, $release_year, $genre, $price, $id]);
    echo "Game updated successfully.";
}
?>