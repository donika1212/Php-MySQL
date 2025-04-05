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
            background: url('background-2.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .header {
            background: rgba(255, 140, 0, 0.0);
            color: rgb(228, 125, 0);
            padding: 15px;
            text-align: center;
            font-size: 30px;
            font-family: Arial Black, Arial Bold, Gadget, sans-serif;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            height: 50px;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .product-list {
            background: rgba(255, 140, 0, 0.3);
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
            color: black;
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
            font-size: 20px;
            font-family: Arial Black, Arial Bold, Gadget, sans-serif;
        }
        th {
            background-color: rgb(5, 66, 158);
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
            background-color: rgb(7, 33, 151);
            border-radius: 30px;
        }
        .delete-btn {
            background-color:rgb(128, 2, 14);
            border-radius: 30px;
        }
        .add-btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(to right, rgba(255, 165, 0, 0.8), rgba(0, 123, 255, 0.8));
            color: black;
            cursor: pointer;
            transition: 0.3s;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Laberion SHPK Logo" class="logo">
        Laberion SHPK - Product Management Dashboard
    </div>
    <div class="container">
        <a href="addproduct.php" class="btn add-btn">Add New Product</a>
        <div class="product-list">
            <h2>Product List</h2>
            <table>
                <tr class ="table-head">
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
                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn edit-btn">Edit</a>
                        <a href="deleteproduct.php?id=<?php echo $product['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
