<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch orders for the logged-in user
$stmt = $pdo->prepare("SELECT orders.id, games.name AS game_name, orders.quantity, orders.order_date 
                       FROM orders 
                       JOIN games ON orders.game_id = games.id 
                       WHERE orders.user_id = (SELECT id FROM users WHERE username = ?)");
$stmt->execute([$_SESSION['username']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle the deletion of an order
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $delete_stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $delete_stmt->execute([$order_id]);
    header("Location: view_orders.php"); // Refresh the page after deletion
    exit();
}

// Handle the editing of an order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_order_id'], $_POST['new_quantity'])) {
    $order_id = $_POST['edit_order_id'];
    $new_quantity = $_POST['new_quantity'];

    // Update the quantity of the order
    $edit_stmt = $pdo->prepare("UPDATE orders SET quantity = ? WHERE id = ?");
    $edit_stmt->execute([$new_quantity, $order_id]);

    header("Location: view_orders.php"); // Refresh the page after editing
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/backround2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 80%;
            max-width: 800px;
            background: linear-gradient(to right, #00bcd4, #ff9800);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: white;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-btn, .edit-btn, .delete-btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
            margin: 10px auto;
        }

        .edit-btn:hover, .delete-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Your Orders</h1>

        <!-- Orders Table -->
        <?php if (count($orders) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Game Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['game_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="edit-btn" onclick="editOrder(<?php echo $order['id']; ?>, <?php echo $order['quantity']; ?>)">Edit</button>
                                <!-- Delete Button -->
                                <a href="?delete_order=<?php echo $order['id']; ?>" class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="color: red;">You have not placed any orders yet.</p>
        <?php endif; ?>

        <!-- Back to Order Games -->
        <a href="place_order.php" class="back-btn">Back to Order Games</a>
    </div>

    <!-- Edit Order Modal -->
    <div id="editOrderModal" style="display:none; text-align:center;">
        <div style="background-color:white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <h3>Edit Order Quantity</h3>
            <form method="POST">
                <input type="hidden" name="edit_order_id" id="edit_order_id">
                <label for="new_quantity">New Quantity:</label>
                <input type="number" name="new_quantity" id="new_quantity" min="1" required>
                <br><br>
                <button type="submit" class="edit-btn">Update Order</button>
                <button type="button" class="delete-btn" onclick="document.getElementById('editOrderModal').style.display = 'none';">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        // Show the Edit Order Modal
        function editOrder(orderId, currentQuantity) {
            document.getElementById('edit_order_id').value = orderId;
            document.getElementById('new_quantity').value = currentQuantity;
            document.getElementById('editOrderModal').style.display = 'block';
        }
    </script>

</body>
</html>

