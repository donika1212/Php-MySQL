<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "<p class='error'>Invalid product ID.</p>";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "<p class='error'>Product not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
        <p><strong>Flavor:</strong> <?php echo htmlspecialchars($product['flavor']); ?></p>
        <p><strong>Production Date:</strong> <?php echo $product['production_date']; ?></p>
        <p><strong>Expiry Date:</strong> <?php echo $product['expiry_date']; ?></p>
        <p><strong>Price:</strong> €<?php echo $product['price']; ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>
