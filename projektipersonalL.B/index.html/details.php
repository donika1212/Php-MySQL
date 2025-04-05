<?php
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$db = "db"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


if (isset($_GET['product'])) {
    $productName = $_GET['product'];


    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name = :product_name");
    $stmt->bindParam(':product_name', $productName);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("Product not specified.");
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .product-details img {
            width: 100%; 
            max-width: 400px; 
            height: auto; 
        }
        .btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar" style="display: flex;">
            <img src="https://1000logos.net/wp-content/uploads/2021/11/Nike-Logo.png" alt="logo" class="brand_logo" style="width: 100px;">
            <div class="links">
                <a href="../index.html/index.php" class="link1">Home</a>
                <a href="../AboutUs/AboutUs.html" class="link2">About Us</a>
                <a href="../ContactUs/contactus.html" class="link3">Contact Us</a>
                <a href="../index.html/viewcart.php" class="link4">View Cart</a>
                <?php if (isset($_SESSION["username"])) { ?>
          <a href="logout.php" class="link5"><?php echo $_SESSION["username"]; ?>, Logout</a>
        <?php } else { ?>
          <a href="signin.php" class="link5">Sign In</a>
        <?php } ?>
            </div>
        </div>
    </header>

    <main>
        <div class="product-details">
            <?php if ($product): ?>
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                <p><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?>€</p>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>

                <form action="viewcart.php" method="post">
                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            <?php else: ?>
                <p>Product not found.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy Nike remake by Ron Shala, Digital School</p>
    </footer>
</body>
</html>
