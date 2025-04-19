<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $flavor = $_POST['flavor'];
    $production_date = $_POST['production_date'];
    $expiry_date = $_POST['expiry_date'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE products SET name=?, flavor=?, production_date=?, expiry_date=?, price=?, description=? WHERE id=?");
    $stmt->execute([$name, $flavor, $production_date, $expiry_date, $price, $description, $id]);

    $updated = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Laberion SHPK</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            text-align: center;
            box-shadow: 0px 6px 15px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
        }

        .edit-container h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .input-field {
            margin: 15px;
            width: 100%;
        }

        .input-field input,
        .input-field textarea {
            width: 90%;
            padding: 10px 10px;
            border: 2px solid transparent;
            border-radius: 20px;
            font-size: 16px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
        }

        .input-field input::placeholder,
        .input-field textarea::placeholder {
            color: white;
        }

        .input-field input:focus,
        .input-field textarea:focus {
            border: 2px solid #007bff;
        }

        button {
            background: linear-gradient(to right, #ff7f00, #007bff);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #007bff, #ff7f00);
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .dashboard-link {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>Edit Product</h2>
    <?php if (isset($updated) && $updated): ?>
        <p class="success-message">Product updated successfully!</p>
        <a class="dashboard-link" href="dashboard.php">← Back to Dashboard</a>
    <?php else: ?>
        <form method="POST">
            <div class="input-field">
                <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" placeholder="Product Name" required>
            </div>
            <div class="input-field">
                <input type="text" name="flavor" value="<?= htmlspecialchars($product['flavor']); ?>" placeholder="Flavor" required>
            </div>
            <div class="input-field">
                <input type="date" name="production_date" value="<?= $product['production_date']; ?>" required>
            </div>
            <div class="input-field">
                <input type="date" name="expiry_date" value="<?= $product['expiry_date']; ?>" required>
            </div>
            <div class="input-field">
                <input type="number" step="0.01" name="price" value="<?= $product['price']; ?>" placeholder="Price (€)" required>
            </div>
            <div class="input-field">
                <textarea name="description" rows="3" placeholder="Description"><?= htmlspecialchars($product['description']); ?></textarea>
            </div>
            <button type="submit">Update Product</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
