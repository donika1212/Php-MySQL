<?php
session_start();
include('db.php');

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding product to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if product already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += $quantity;  // Update the quantity if already in cart
            $found = true;
            break;
        }
    }

    // If product is not found, add new entry to the cart
    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
    }

    // Redirect to cart page after adding product to the cart
    header("Location: cart.php");
    exit();
}

// Handle removing products from the cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Update cart item quantity
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['new_quantity'];

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] = $new_quantity;
            break;
        }
    }
}

// Retrieve product details from the database based on the products in the cart
$product_ids = array_map(function ($item) {
    return $item['product_id'];
}, $_SESSION['cart']);

// Only run the query if there are products in the cart
if (!empty($product_ids)) {
    // Change 'product_id' to 'id' (assuming 'id' is the column name in the database)
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $query = "SELECT * FROM products WHERE id IN ($placeholders)"; // Use 'id' instead of 'product_id'
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters dynamically for mysqli
    $types = str_repeat('i', count($product_ids)); // Assuming all product_ids are integers
    mysqli_stmt_bind_param($stmt, $types, ...$product_ids);

    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // If the cart is empty, no products to retrieve
    $products = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - StyleNest</title>
    <link rel="stylesheet" href="styleeeee.css">
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

    <!-- Cart Section -->
    <main class="main-content">
        <div class="container">
            <h2 class="section-title">Your Cart</h2>

            <?php if (empty($products)) { ?>
                <p>Your cart is empty. <a href="products.php">Shop now!</a></p>
            <?php } else { ?>
                <div class="cart-items">
                    <?php foreach ($_SESSION['cart'] as $cart_item) {
                        // Find product details for each cart item
                        $product = null;
                        foreach ($products as $prod) {
                            if ($prod['id'] == $cart_item['product_id']) { // Use 'id' instead of 'product_id'
                                $product = $prod;
                                break;
                            }
                        }
                        if ($product) {
                            echo "
                            <div class='cart-item'>
                                <img src='images/{$product['image']}' alt='{$product['name']}' class='cart-item-image'>
                                <div class='cart-item-details'>
                                    <h3 class='cart-item-name'>{$product['name']}</h3>
                                    <p class='cart-item-price'>\${$product['price']}</p>
                                    <p class='cart-item-quantity'>Quantity: {$cart_item['quantity']}</p>
                                    <a href='cart.php?remove={$cart_item['product_id']}'>Remove</a>
                                </div>
                            </div>
                            ";
                        }
                    } ?>
                </div>
            <?php } ?>
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
