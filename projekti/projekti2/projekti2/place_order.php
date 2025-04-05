<?php
session_start();
include 'config.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch available games from the database
$stmt = $pdo->query("SELECT * FROM games"); // Changed from `mms.orders` to `mms`
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission for placing an order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['game_id'], $_POST['quantity'])) {
    $game_id = $_POST['game_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id']; // Get user_id from session

    // Insert the order into the orders table
    $stmt = $pdo->prepare("INSERT INTO orders (game_id, user_id, quantity) VALUES (?, ?, ?)");
    if ($stmt->execute([$game_id, $user_id, $quantity])) {
        echo "<p>Order placed successfully!</p>";
    } else {
        echo "<p>Error placing order. Try again later.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Games</title>
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

        .games {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .game-card {
            background: white;
            padding: 15px;
            border-radius: 5px;
            width: 250px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .game-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .order-btn {
            display: block;
            margin-top: 10px;
            padding: 8px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .order-btn:hover {
            background: #218838;
        }

        .view-orders-btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 200px;
            margin: 0 auto;
        }

        .view-orders-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Order Your Favorite Games</h1>

        <div class="games">
            <?php foreach ($games as $game) { ?>
                <div class="game-card">
                    <img src="<?php echo htmlspecialchars($game['image_path']); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>"
                    onerror="this.src='images/default.jpg'; console.log('Image not found:', this.src);">
                    <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                    <p>Price: $<?php echo htmlspecialchars($game['price']); ?></p>
                    <form method="POST">
                        <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" min="1" value="1" required><br>
                        <button type="submit" class="order-btn">Order Now</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <!-- Link to View Orders -->
        <a href="view_orders.php" class="view-orders-btn">View My Orders</a>
    </div>

</body>
</html>
