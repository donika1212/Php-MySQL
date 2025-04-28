<?php
session_start();
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get car_id from the form submission (from Buy Now button)
if (isset($_POST['car_id'])) {
    $user_id = $_SESSION['user_id'];
    $car_id = $_POST['car_id'];
    $status = 'Pending'; // Default status for a new order

    // Insert the order into the database
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, car_id, status) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $car_id, $status]);

    // Redirect to the orders page after placing the order
    header("Location: orders.php");
    exit();
}
?>
