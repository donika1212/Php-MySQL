
<?php



$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing Store</title>
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 200px;
            float: left;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Welcome to Our Clothing Store</h1>
    <div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>$' . $row['price'] . '</p>';
                echo '<a href="add_to_cart.php?id=' . $row['id'] . '">Add to Cart</a>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</body>
</html>