<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food-order1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['full-name']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $quantity = intval($_POST['qty']);
    $foodTitle = "Food Title"; // This can be dynamic if fetching from a database
    $price = 2.3;
    $totalPrice = $price * $quantity;

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (full_name, contact, email, address, food_title, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssid", $fullName, $contact, $email, $address, $foodTitle, $quantity, $totalPrice);

    if ($stmt->execute()) {
        echo "<script>alert('Order Confirmed! Thank you, $fullName.');</script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Order</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="foods.php">Foods</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                        <img src="images/menu-pizza.jpg" alt="Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3>Food Title</h3>
                        <p class="food-price">$2.3</p>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Artiol Thaqi" class="input-responsive" required>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@artiolthaqi.com" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Artiol Thaqi</a></p>
        </div>
    </section>
</body>
</html>
