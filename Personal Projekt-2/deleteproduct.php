<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$product_id]);

    $_SESSION['message'] = "Product deleted successfully!";
    header("Location: dashboard.php");
    exit;
    
} else {
    header("Location: dashboard.php");
    exit;
}
?>