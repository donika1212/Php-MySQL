<?php
include 'config.php';
$product_added = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $flavor = $_POST['flavor'];
    $production_date = $_POST['production_date'];
    $expiry_date = $_POST['expiry_date'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO products (name, flavor, production_date, expiry_date, price, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $flavor, $production_date, $expiry_date, $price, $description]);
    $product_added = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        input, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .input-field{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.3);
            color: black;
            outline: none;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
        }
        .input-field::placeholder{
            color: black;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(to right, rgba(255, 165, 0, 0.8), rgba(0, 123, 255, 0.8));
            color: black;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: linear-gradient(to right, rgba(255, 140, 0, 0.9), rgba(0, 102, 204, 0.9));
        }
        .success {
            color: rgba(5, 66, 158, 0.9);
            font-weight: bold;
        }
        .dashboard-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(to right, rgba(255, 165, 0, 0.8), rgba(0, 123, 255, 0.8));
            color: black;
            cursor: pointer;
            transition: 0.3s;
        }
        .dashboard-button:hover {
            background: linear-gradient(to right, rgba(255, 140, 0, 0.9), rgba(0, 102, 204, 0.9));
        }
        input{
            background-color: rgba(5, 66, 158, 0.9);
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <form method="POST" >
            <input type="text" name="name" placeholder="Juice Name" class="input-field" required>
            <input type="text" name="flavor" placeholder="Flavor" class="input-field" required>
            <input type="date" name="production_date" class="input-field" required>
            <input type="date" name="expiry_date" class="input-field" required>
            <input type="number" step="0.01" name="price" placeholder="Price" class="input-field" required>
            <textarea name="description" placeholder="Description" class ="input-field"></textarea>
            <button type="submit">Add Product</button>
        </form>
        <?php if ($product_added): ?>
            <p class='success'>Product added successfully!</p>
            <a href="dashboard.php" class="dashboard-button">Go to Dashboard</a>
        <?php endif; ?>
    </div>
</body>
</html>
