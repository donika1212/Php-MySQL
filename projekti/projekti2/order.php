<a href="place_order.php?game_id=<?php echo $game['id']; ?>">
    <button class="order-btn">Order Now</button>
</a>
 <?php 

session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch available games from the database
$stmt = $pdo->query("SELECT * FROM games"); // Changed from `mms.orders` to `mms`
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Games</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; }
        .games { display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; }
        .game-card { background: white; padding: 15px; border-radius: 5px; width: 250px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .game-card img { width: 100%; height: auto; border-radius: 5px; }
        .order-btn { display: block; margin-top: 10px; padding: 8px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; }
        .order-btn:hover { background: #218838; }
    </style>
</head>
<body>
    <h1>Order Your Favorite Games</h1>
    <div class="games">
        <?php foreach ($games as $game) { ?>
            <div class="game-card">
                <img src="<?php echo htmlspecialchars($game['images']); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>" 
                onerror="this.src='images/default.jpg'; console.log('Image not found:', this.src);">
                <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                <p>Price: $<?php echo htmlspecialchars($game['price']); ?></p>
                <a href="place_order.php?id=<?php echo $game['id']; ?>" class="order-btn">Order Now</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>