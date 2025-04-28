<?php
session_start();
include('config.php');

// Fetch all cars from the database
$stmt = $pdo->query("SELECT * FROM cars");
$cars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Ajsy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    Auto Ajsy
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

<div class="container">
    <h1>Welcome to Auto Ajsy</h1>

    <div class="cars-list">
        <?php foreach ($cars as $car): ?>
            <div class="car-card">
                <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
                <h2><?php echo $car['make'] . ' ' . $car['model']; ?></h2>
                <p>Year: <?php echo $car['year']; ?></p>
                <p>Price: $<?php echo number_format($car['price'], 2); ?></p>

                <!-- Form to place an order -->
                <form action="order.php" method="POST">
                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                    <input type="submit" value="Buy Now">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 Auto Ajsy</p>
</footer>

</body>
</html>
