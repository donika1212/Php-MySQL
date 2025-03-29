<?php
session_start();
require 'config.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['game_id'])) {
    die("Game not found.");
}

$game_id = $_GET['game_id'];
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$game_id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    die("Game not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];

    $order_stmt = $pdo->prepare("INSERT INTO orders (user_id, game_id, quantity) VALUES (?, ?, ?)");
    $order_stmt->execute([$user_id, $game_id, $quantity]);

    echo "<script>alert('Order placed successfully!'); window.location.href='dashboard.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Order: <?php echo htmlspecialchars($game['name']); ?></h2>
    <form method="post">
        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1" required>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
