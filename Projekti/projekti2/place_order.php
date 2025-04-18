
<?php
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['game_id'])) {
    header("Location: dashboard.php");
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$_GET['game_id']]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    header("Location: dashboard.php");
    exit();
}


function getGameImage($gameName) {
    $gameImages = [
        'grand theft auto' => 'gta-v.jpg',
        'counter-strike' => 'csgo.jpg',
        'fifa' => 'fifa-22.jpg',
        'elden' => 'elden-ring.jpg',
        'cyberpunk' => 'cyberpunk-2077.jpg',
        'Red Dead Redemption 2' => 'red-dead-2.jpg',
        'The Witcher 3' => 'witcher-3.jpg',
        'God of War' => 'god-of-war.jpg',
        'Minecraft' => 'minecraft.jpg',
        'Call of Duty: Modern Warfare' => 'cod-mw.jpg',
        'Assassins Creed Valhalla' => 'ac-valhalla.jpg',
        'Spider-Man' => 'spiderman.jpg',
        'Resident Evil 4 Remake' => 're4-remake.jpg'
    ];
    
    foreach ($gameImages as $keyword => $filename) {
        if (stripos(strtolower($gameName), strtolower($keyword)) !== false) {
            if (file_exists('images/' . $filename)) {
                return 'images/' . $filename;
            }
        }
    }
    return 'images/default.jpg';
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id']; 
    $game_id = $_GET['game_id'];

    $stmt = $pdo->prepare("INSERT INTO orders (game_id, user_id, quantity) VALUES (?, ?, ?)");
    if ($stmt->execute([$game_id, $user_id, $quantity])) {
        $orderSuccess = true;
    } else {
        $orderError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - <?php echo htmlspecialchars($game['name']); ?></title>
    <style>
        body {
            background-image: url('images/backround2.jpg');
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .quantity-selector {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .page-wrapper {
            background: rgba(0, 0, 0, 0.7);
            min-height: 100vh;
            padding-bottom: 50px;
        }
        
        .navbar {
            background-color: rgba(0, 0, 0, 0.83);
            padding: 15px;
            margin-bottom: 30px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .payment-methods .method label {
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
        }
        
        .payment-methods .method input[type="radio"] {
            width: 20px;
            height: 20px;
            border: 2px solid #4CAF50;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .payment-methods .method input[type="radio"]:checked {
            border-color: #3e8e41;
            background: linear-gradient(135deg, #4CAF50 0%, #3e8e41 100%);
        }
        
        .quantity-selector input[type="number"] {
            width: 80px;
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            text-align: center;
            font-size: 14px;
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .game-details {
            background: rgba(30, 30, 30, 0.95);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            gap: 50px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .game-image {
            max-width: 400px;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .game-image:hover {
            transform: scale(1.02);
        }
        
        .game-info {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.1) 100%);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        h1 {
            color:rgb(228, 76, 38);
            margin-top: 0;
            font-size: 32px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
        }
        
        .game-details h2 {
            margin: 0 0 20px 0;
            color: #4CAF50;
            font-size: 24px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .price {
            font-size: 28px;
            color: #4CAF50;
            margin: 20px 0;
            font-weight: bold;
        }
        
        .price-display {
            margin-top: 20px;
            padding: 20px;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.1) 100%);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .price-display h3 {
            color: #4CAF50;
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: 600;
        }
        
        .price-display p {
            margin: 0;
            font-size: 28px;
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 1px;
        }
        
        .order-form {
            margin-top: 30px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color:rgb(231, 101, 49);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 12px;
            border: 2px solid red;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color:rgb(245, 28, 28);
            box-shadow: 0 0 15px rgba(251, 255, 12, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background-color: #000;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
        }
        
        .btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }
        
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }
        
        .error-message {
            background-color: #f44336;
            color: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }
        
        @media (max-width: 900px) {
            .game-details {
                flex-direction: column;
                align-items: center;
                padding: 20px;
            }

            .game-image {
                width: 100%;
                max-width: 400px;
                height: auto;
            }

            .game-info {
                text-align: center;
            }

            .btn {
                margin: 30px auto 0;
            }
        }

        .btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }

        .error-message {
            background-color: #f44336;
            color: white;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="view_orders.php">My Orders</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <?php if (isset($orderSuccess)): ?>
            <div class="success-message">Order placed successfully!</div>
        <?php endif; ?>
        
        <?php if (isset($orderError)): ?>
            <div class="error-message">Error placing order. Please try again.</div>
        <?php endif; ?>

        <div class="game-details">
            <img class="game-image" src="<?php echo htmlspecialchars(getGameImage($game['name'])); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>">
            <div class="game-info">
                <h1><?php echo htmlspecialchars($game['name']); ?></h1>
                <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
                <p><strong>Release Year:</strong> <?php echo htmlspecialchars($game['release_year']); ?></p>
                <p><strong>Genre:</strong> <?php echo htmlspecialchars($game['genre']); ?></p>
                <div class="price">$<?php echo htmlspecialchars($game['price']); ?></div>
                
                <form method="POST" class="order-form">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>