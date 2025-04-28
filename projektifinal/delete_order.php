<?php
session_start();
include('config.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if the order_id is set in the request
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    
    // Delete the order from the database
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$order_id, $_SESSION['user_id']]);

    // Redirect back to orders page with a success message
    $_SESSION['order_canceled'] = "Your order has been canceled successfully.";
    header('Location: orders.php');
    exit();
} else {
    // If no order_id was sent, redirect to orders page with an error
    $_SESSION['error'] = "No order selected to cancel.";
    header('Location: orders.php');
    exit();
}
