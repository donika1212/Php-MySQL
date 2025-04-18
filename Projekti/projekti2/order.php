<?php 
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['game_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([$_GET['game_id']]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$game) {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}


function getGameImage($gameName) {
 
    $gameImages = [
       
        'grand theft auto' => 'gta-v.jpg',
        'gta v' => 'gta-v.jpg',
        'counter-strike' => 'csgo.jpg',
        'csgo' => 'csgo.jpg',
        'cs:go' => 'csgo.jpg',
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

  
    $finalImagePath = 'images/default.jpg';
    foreach ($gameImages as $keyword => $filename) {
        if (stripos(strtolower($gameName), strtolower($keyword)) !== false) {
            if (file_exists('images/' . $filename)) {
                $finalImagePath = 'images/' . $filename;
                break;
            }
        }
    }
    return $finalImagePath;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Game - <?php echo htmlspecialchars($game['name']); ?></title>
    <style>
        body {
            background-image: url('images/backround2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }

        .page-wrapper {
            background: rgba(0, 0, 0, 0.7);
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .navbar a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
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
            width: 400px;
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .game-image:hover {
            transform: scale(1.02);
        }

        .game-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .game-info h1 {
            font-size: 2.5em;
            margin: 0 0 20px 0;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .game-info p {
            font-size: 1.2em;
            margin: 10px 0;
            color: #ccc;
            line-height: 1.6;
        }

        .game-info strong {
            color: white;
            font-weight: 600;
        }

        .price {
            font-size: 3em;
            color: #4CAF50;
            font-weight: bold;
            margin: 30px 0;
            text-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg,rgb(197, 35, 202), #1976D2);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 1.2em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-align: center;
            max-width: 250px;
            margin-top: auto;
        }

        .btn:hover {
            background: linear-gradient(135deg,rgb(194, 22, 22), #0D47A1);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.4);
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
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="navbar">
            <a href="dashboard.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="container">
            <div class="game-details">
                <img class="game-image" src="<?php echo htmlspecialchars(getGameImage($game['name'])); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>">
                <div class="game-info">
                    <h1><?php echo htmlspecialchars($game['name']); ?></h1>
                    <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
                    <p><strong>Release Year:</strong> <?php echo htmlspecialchars($game['release_year']); ?></p>
                    <p><strong>Genre:</strong> <?php echo htmlspecialchars($game['genre']); ?></p>
                    <p><strong>Price:</strong> <span class="price">$<?php echo number_format($game['price'], 2); ?></span></p>
                    <a href="game_description.php?game_id=<?php echo htmlspecialchars($game['id']); ?>" class="btn">View Description</a>
                    <a href="place_order.php?game_id=<?php echo htmlspecialchars($game['id']); ?>" class="btn">Purchase Now</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
