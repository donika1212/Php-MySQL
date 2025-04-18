<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$userStmt = $pdo->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
$userStmt->execute([$_SESSION['username']]);
$userId = $userStmt->fetchColumn();


$stmt = $pdo->prepare("SELECT orders.id, games.name AS game_name, orders.quantity, orders.order_date, games.price,
                              (orders.quantity * games.price) as total_price
                       FROM orders 
                       JOIN games ON orders.game_id = games.id 
                       WHERE orders.user_id = ?
                       ORDER BY orders.order_date DESC");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


$grandTotal = 0;
foreach ($orders as $order) {
    $grandTotal += $order['total_price'];
}


if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $delete_stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $delete_stmt->execute([$order_id, $userId]);
    header("Location: view_orders.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_order_id'], $_POST['new_quantity'])) {
    $order_id = $_POST['edit_order_id'];
    $new_quantity = $_POST['new_quantity'];
    $edit_stmt = $pdo->prepare("UPDATE orders SET quantity = ? WHERE id = ? AND user_id = ?");
    $edit_stmt->execute([$new_quantity, $order_id, $userId]);
    header("Location: view_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders - Game Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-image: url('images/backround2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 25px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .header h1 {
            font-size: 2.5em;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 800;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 25px;
            background: rgba(76, 175, 80, 0.3);
            border: 1px solid rgba(76, 175, 80, 0.5);
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .nav-links a:hover {
            background: rgba(76, 175, 80, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .orders-container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .order-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .order-card:hover::before {
            opacity: 1;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .game-icon {
            font-size: 2em;
            margin-right: 15px;
            color: #4CAF50;
            text-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
            vertical-align: middle;
        }

        .game-title {
            display: flex;
            align-items: center;
        }

        .game-title h3 {
            margin-left: 10px;
        }

        .order-date {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9em;
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .detail-label {
            color: #4CAF50;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .detail-value {
            font-size: 1.2em;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .order-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(76, 175, 80, 0.3);
            color: white;
            border: 1px solid rgba(76, 175, 80, 0.5);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.5px;
        }

        .btn:hover {
            background: rgba(76, 175, 80, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-delete {
            background: rgba(244, 67, 54, 0.3);
            border: 1px solid rgba(244, 67, 54, 0.5);
        }

        .btn-delete:hover {
            background: rgba(244, 67, 54, 0.5);
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }

        .edit-form {
            display: none;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .edit-form input[type="number"] {
            padding: 10px;
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.3);
            color: white;
            margin-right: 15px;
            width: 100px;
            text-align: center;
            font-size: 1.1em;
        }

        .grand-total {
            margin-top: 40px;
            padding: 25px;
            background: rgba(76, 175, 80, 0.2);
            border-radius: 15px;
            text-align: right;
            font-size: 1.8em;
            font-weight: bold;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(76, 175, 80, 0.5);
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.3), rgba(0, 0, 0, 0.3));
        }

        .empty-orders {
            text-align: center;
            padding: 60px;
            font-size: 1.3em;
            color: rgba(255, 255, 255, 0.7);
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
                padding: 20px;
            }

            .order-card {
                text-align: center;
                gap: 20px;
            }

            .order-details {
                grid-template-columns: 1fr;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .nav-links a {
                width: 100%;
                text-align: center;
            }

            .order-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .order-actions {
                justify-content: center;
                flex-wrap: wrap;
            }

            .grand-total {
                text-align: center;
                font-size: 1.5em;
            }

            .edit-form {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .edit-form input[type="number"] {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 2em;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Orders</h1>
            <div class="nav-links">
                <a href="dashboard.php">Back to Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="orders-container">
            <?php if (empty($orders)): ?>
                <div class="empty-orders">
                    <p>You haven't placed any orders yet.</p>
                </div>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div class="game-title">
                                <i class="fas fa-gamepad game-icon"></i>
                                <h3><?php echo htmlspecialchars($order['game_name']); ?></h3>
                            </div>
                            <span class="order-date"><?php echo date('F j, Y', strtotime($order['order_date'])); ?></span>
                        </div>
                        <div class="order-details">
                            <div class="detail-item">
                                <span class="detail-label">Quantity</span>
                                <span class="detail-value"><?php echo $order['quantity']; ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Price per Item</span>
                                <span class="detail-value">$<?php echo number_format($order['price'], 2); ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Total Price</span>
                                <span class="detail-value">$<?php echo number_format($order['total_price'], 2); ?></span>
                            </div>
                        </div>
                        <div class="order-actions">
                            <button class="btn" onclick="toggleEdit(<?php echo $order['id']; ?>)">
                                <i class="fas fa-edit"></i> Edit Order
                            </button>
                            <button class="btn btn-delete" onclick="confirmDelete(<?php echo $order['id']; ?>)">
                                <i class="fas fa-trash"></i> Delete Order
                            </button>
                        </div>
                        <form class="edit-form" id="edit-form-<?php echo $order['id']; ?>" action="view_orders.php" method="POST">
                            <input type="hidden" name="edit_order_id" value="<?php echo $order['id']; ?>">
                            <input type="number" name="new_quantity" value="<?php echo $order['quantity']; ?>" min="1" required>
                            <button type="submit" class="btn">Update Quantity</button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <div class="grand-total">
                    Grand Total: $<?php echo number_format($grandTotal, 2); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmDelete(orderId) {
            if (confirm('Are you sure you want to delete this order?')) {
                window.location.href = 'view_orders.php?delete_order=' + orderId;
            }
        }

        function toggleEdit(orderId) {
            const form = document.getElementById('edit-form-' + orderId);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
