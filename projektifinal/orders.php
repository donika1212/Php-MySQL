<?php
session_start();
include('config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch the user's orders and the associated car details
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT orders.*, cars.make, cars.model, cars.year, cars.price FROM orders 
                       JOIN cars ON orders.car_id = cars.id
                       WHERE orders.user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders - Auto Ajsy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
Auto Ajsy - Your Orders
</header>

<nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="orders.php">Your Orders</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>    
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>

<!-- Wrap the content in the container-orders -->
<div class="container-orders">
    <div class="orders-container">
        <h2>Your Orders</h2>

        <!-- Check if the user has any orders -->
        <?php if (count($orders) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Order Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['make'] . ' ' . $order['model'] . ' (' . $order['year'] . ')'; ?></td>
                            <td><?php echo date("F j, Y", strtotime($order['order_date'])); ?></td>
                            <td>$<?php echo number_format($order['price'], 2); ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <!-- Delete button -->
                                <form action="delete_order.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <input type="submit" value="Cancel Order" class="delete-btn">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have not placed any orders yet.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 Auto Ajsy</p>
</footer>

</body>
</html>
