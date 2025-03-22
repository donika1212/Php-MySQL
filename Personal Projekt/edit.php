<?php
include 'config.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $flavor = $_POST['flavor'];
    $production_date = $_POST['production_date'];
    $expiry_date = $_POST['expiry_date'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("UPDATE products SET name=?, flavor=?, production_date=?, expiry_date=?, price=?, description=? WHERE id=?");
    $stmt->execute([$name, $flavor, $production_date, $expiry_date, $price, $description, $id]);
    echo "<p class='success'>Product updated successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        input, textarea, button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST">
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            <input type="text" name="flavor" value="<?php echo htmlspecialchars($product['flavor']); ?>" required>
            <input type="date" name="production_date" value="<?php echo $product['production_date']; ?>" required>
            <input type="date" name="expiry_date" value="<?php echo $product['expiry_date']; ?>" required>
            <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
