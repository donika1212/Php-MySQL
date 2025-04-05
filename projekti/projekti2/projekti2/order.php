<?php 
session_start();
include 'config.php';

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch available games from the database
$stmt = $pdo->query("SELECT * FROM games"); 
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Games</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff); /* Linear gradient background */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Container Styling */
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
            text-align: center;
            background: linear-gradient(to right, #ff9966, #ff5e62); /* Sexy gradient on container */
        }

        /* Heading Styling */
        h1 {
            font-size: 2rem;
            color: #fff; /* Light color for contrast */
            margin-bottom: 30px;
        }

        /* Game Display Grid */
        .games {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Individual Game Card Styling */
        .game-card {
            background: linear-gradient(135deg, #ff5e62, #ff9966); /* Gradient background for the game cards */
            padding: 20px;
            border-radius: 10px;
            width: 250px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Hover Effect for Game Cards */
        .game-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .game-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        /* Game Name Styling */
        .game-card h3 {
            color: #fff; /* White color to contrast well with the gradient */
            font-size: 1.2rem;
            margin: 10px 0;
        }

        /* Game Price Styling */
        .game-card p {
            color: #fff; /* White price text */
            font-size: 1rem;
            margin: 5px 0;
        }

        /* Order Button Styling */
        .order-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover Effect for Order Button */
        .order-btn:hover {
            background-color: #218838;
            transform: scale(1.05);
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
                    <!-- Link to the place_order.php page with game_id as a query parameter -->
                    <a href="place_order.php?game_id=<?php echo $game['id']; ?>" class="order-btn">Order Now</a>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>
