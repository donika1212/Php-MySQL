
<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM games ORDER BY RAND() LIMIT 5");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; text-align: center; }
        .navbar { background-color: #007bff; padding: 15px; }
        .navbar a { color: white; text-decoration: none; padding: 10px 15px; font-size: 18px; }
        .games { display: flex; justify-content: center; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
        .game-card { background: white; padding: 15px; border-radius: 5px; width: 250px; text-align: center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .game-card img { width: 100%; height: auto; border-radius: 5px; }
        .game-card h3 { margin: 10px 0; }
        .game-card a { display: block; margin-top: 10px; padding: 8px 12px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <a href="merree.php">Manage Users</a>
        <a href="logout.php">Logout</a>
    </div>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Click on a game to order:</p>
    <div class="games">
        <?php foreach ($games as $game) { ?>
            <div class="game-card">
                <img src="<?php echo htmlspecialchars($game['image']); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>">
                <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($game['price']); ?></p>
                <a href="order.php?game_id=<?php echo $game['id']; ?>">Order Now</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>