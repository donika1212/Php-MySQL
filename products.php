<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Collection - StyleNest</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<body>

    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <h1>StyleNest Clothing</h1>
            <nav>
                <a href="index.html">Home</a>
                <a href="products.php">Our Collection</a>
                <a href="cart.php">Cart</a>
            </nav>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="main-content">
        <div class="container">
            <h2 class="section-title">Our Collection</h2>
            <div class="products">
                <?php
                $result = mysqli_query($conn, "SELECT * FROM products");
                $image_counter = 1; // Counter to switch between the images

                while ($row = mysqli_fetch_assoc($result)) {
                    // Select image dynamically based on counter
                    $image_name = "clothes{$image_counter}.jpg";
                    $image_counter++;
                    if ($image_counter > 3) {
                        $image_counter = 1; // Reset counter to 1 after the third image
                    }
                    echo "
                    <div class='product-card'>
                        <img src='images/{$image_name}' alt='{$row['name']}' class='product-image'>
                        <div class='product-details'>
                            <h3 class='product-name'>{$row['name']}</h3>
                            <p class='product-price'>\${$row['price']}</p>
                            <form action='cart.php' method='post' class='purchase-form'>
                                <input type='hidden' name='product_id' value='{$row['id']}'>
                                <input type='text' name='customer_name' placeholder='Your Name' class='input-field' required>
                                <input type='number' name='quantity' value='1' min='1' class='input-field' required>
                                <input type='submit' value='Buy Now' name='add_to_cart' class='buy-button'>
                            </form>
                        </div>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 StyleNest. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
