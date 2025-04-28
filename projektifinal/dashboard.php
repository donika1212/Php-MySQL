<?php
session_start();
include('config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch the user's orders
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$orders = $stmt->fetchAll();

// Fetch the logged-in user's details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();

// Fetch all cars for purchase
$stmt = $pdo->query("SELECT * FROM cars");
$cars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard - Auto Ajsy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    Car Dealership - Auto Ajsy
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

<div class="container dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

    <!-- Show user's profile details -->
    <div class="user-profile">
        <h3>Your Profile</h3>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Joined:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
    </div>

    <!-- Show user's orders -->
    <div class="dashboard-actions">
        <h3>Your Orders</h3>
        <ul>
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <li>Ordered: <?php echo $order['car_id']; ?> on <?php echo $order['order_date']; ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have not made any orders yet.</p>
            <?php endif; ?>
        </ul>
    </div>

    <div class="dashboard-actions">
    <h3>Your Orders</h3>
    <p><a href="orders.php">View your detailed orders</a></p>
</div>


    <!-- Show available cars for purchase -->
    <div class="dashboard-actions">
        <h3>Available Cars</h3>
        <div class="dashboard-cars">
            <?php foreach ($cars as $car): ?>
                <div class="car-card">
                    <img src="<?php echo $car['image']; ?>" alt="Car Image">
                    <h2><?php echo $car['make'] . ' ' . $car['model']; ?></h2>
                    <p>Year: <?php echo $car['year']; ?></p>
                    <p>Price: $<?php echo number_format($car['price'], 2); ?></p>
                    <a href="order.php?car_id=<?php echo $car['id']; ?>">Buy Now</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Auto Ajsy</p>
</footer>

</body>
</html>
