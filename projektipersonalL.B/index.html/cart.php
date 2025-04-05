<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $product = $_POST['product'];
        $price = $_POST['price'];

        $_SESSION['cart'][] = [
            'product' => $product,
            'price' => $price,
        ];

        $stmt = $conn->prepare("INSERT INTO cart (product, price) VALUES (:product, :price)");
        $stmt->bindParam(':product', $product);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        header('Location: index.html');
        exit();
    } elseif ($_POST['action'] === 'remove') {
        $productToRemove = $_POST['product'];

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product'] === $productToRemove) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        $stmt = $conn->prepare("DELETE FROM cart WHERE product = :product");
        $stmt->bindParam(':product', $productToRemove);
        $stmt->execute();

        header('Location: viewcart.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="navbar" style="display: flex;">
        <img src="https://1000logos.net/wp-content/uploads/2021/11/Nike-Logo.png" alt="logo" class="brand_logo" style="width: 100px;">
        <div class="links">
            <a href="../index.html/index.html" class="link1">Home</a>
            <a href="../AboutUs/AboutUs.html" class="link2">AboutUs</a>
            <a href="../ContactUs/contactus.html" class="link3">ContactUs</a>
        </div>
    </div>
</header>
<main>
    <h2 style="text-align:center; font-size: 20px;">Your Cart</h2>
    <div class="cart-container" style="text-align:center;">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p>Your cart is empty.</p>";
        } else {
            echo "<table style='margin: 0 auto;'>";
            echo "<tr><th>Product</th><th>Price</th><th>Action</th></tr>";
            foreach ($_SESSION['cart'] as $item) {
                echo "<tr><td>{$item['product']}</td><td>{$item['price']}€</td>";
                echo "<td>
                        <form action='view_cart.php' method='post' style='display:inline;'>
                            <input type='hidden' name='action' value='remove'>
                            <input type='hidden' name='product' value='{$item['product']}'>
                            <button type='submit' class='btn'>Remove</button>
                        </form>
                      </td></tr>";
            }
            echo "</table>";
        }
        ?>
        <a href="#" class="btn">Proceed to Checkout</a>
    </div>
</main>
<footer>
    <p>&copy; ]Ron Shala, Digital School Final Project</p><br>
</footer>
</body>
</html>
