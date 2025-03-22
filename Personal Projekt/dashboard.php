<?php
include 'config.php';
session_start();

// Fetch all products from the database
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #28a745;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .product-list {
            background: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-btn {
            background-color: #ffc107;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .add-btn {
            background-color: #007bff;
            padding: 10px 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">Laberion SHPK - Product Management Dashboard</div>
    <div class="container">
        <a href="addproduct.php" class="btn add-btn">Add New Product</a>
        <div class="product-list">
            <h2>Product List</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Flavor</th>
                    <th>Production Date</th>
                    <th>Expiry Date</th>
                    <th>Price (€)</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['flavor']); ?></td>
                    <td><?php echo $product['production_date']; ?></td>
                    <td><?php echo $product['expiry_date']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>
                        <a href="editproduct.php?id=<?php echo $product['id']; ?>" class="btn edit-btn">Edit</a>
                        <a href="deleteproduct.php?id=<?php echo $product['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
