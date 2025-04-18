<?php 
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


if (isset($_GET['game_id'])) {
    $stmt = $pdo->prepare("SELECT id, name, developer, release_year, genre, price, image, requirements, description FROM games WHERE id = ?");
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
    <title>Game Description - <?php echo htmlspecialchars($game['name']); ?></title>
    <style>
        body {
            background-image: url('images/backround2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            backdrop-filter: blur(5px);
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1em;
            transition: all 0.3s ease;
            position: relative;
            padding: 5px 10px;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #4CAF50;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .game-container {
            max-width: 1400px;
            margin: 80px auto 40px;
            padding: 0 20px;
            position: relative;
        }

        .game-info {
            display: flex;
            gap: 60px;
            margin-top: 60px;
            align-items: flex-start;
            padding: 40px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .game-image {
            width: 400px;
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .game-image:hover {
            transform: scale(1.02);
        }

        .game-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .game-image:hover img {
            transform: scale(1.1);
        }

        .game-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 20px;
        }

        .game-name {
            font-size: 2.5em;
            font-weight: bold;
            color: #fff;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .game-price {
            font-size: 2.5em;
            font-weight: 900;
            color: #fff;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .game-price::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(76, 175, 80, 0.2));
            border-radius: 20px;
        }

        .game-description {
            font-size: 1.4em;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.95);
            text-align: justify;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 20px;
        }

        .purchase-section {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            padding: 25px;
            background: linear-gradient(135deg, rgb(0, 0, 0) 0%, rgb(17, 82, 4) 100%);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(114, 228, 8, 0.3);
        }

        .purchase-section:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .price-tag {
            font-size: 3em;
            font-weight: 900;
            color: #fff;
            background: linear-gradient(135deg, #4CAF50,rgb(0, 0, 0));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            padding: 20px;
            border-radius: 20px;
            position: relative;
        }

        .price-tag::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(76, 175, 80, 0.2));
            border-radius: 20px;
        }

        .purchase-button {
            background: linear-gradient(45deg,rgb(255, 255, 255), rgb(17, 82, 4));
            color: black;
            padding: 22px 50px;
            border: none;
            border-radius: 35px;
            font-size: 1.4em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(76, 175, 80, 0.3);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 20px;
        }

        .purchase-button:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(76, 175, 80, 0.4);
        }

        .purchase-button:active {
            transform: translateY(0);
        }

        .purchase-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2));
            transition: 0.5s;
        }

        .purchase-button:hover::before {
            left: 100%;
        }

        .detail-item {
            position: relative;
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .detail-item ul {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-left: 20px;
        }

        .detail-item ul li {
            margin-bottom: 8px;
            color: #fff;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .detail-item ul li:hover {
            opacity: 1;
        }

        .detail-item h3 {
            margin: 0 0 30px 0;
            color: #fff;
            font-size: 1.6em;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
            position: relative;
            font-weight: 600;
        }

        .detail-item h3::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
            transition: width 0.3s ease;
        }

        .detail-item:hover h3::after {
            width: 100%;
        }

        .detail-item p {
            margin: 0;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
            font-size: 1.2em;
        }

        .detail-item ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .detail-item ul li {
            margin-bottom: 20px;
            padding-left: 30px;
            position: relative;
            font-size: 1.2em;
        }

        .detail-item ul li::before {
            content: '•';
            color: #4CAF50;
            position: absolute;
            left: 0;
            font-size: 1.4em;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="header">
            <div class="nav-links">
                <a href="dashboard.php">Home</a>
                <a href="order.php?game_id=<?php echo htmlspecialchars($game['id']); ?>">Back to Order</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="game-container">
            <div class="game-info">
                <div class="game-image">
                    <img src="<?php echo htmlspecialchars(getGameImage(strtolower($game['name']))); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>">
                </div>
                <div class="game-details">
                    <h1><?php echo htmlspecialchars($game['name']); ?></h1>
                    <div class="game-price">$<?php echo number_format($game['price'], 2); ?></div>
                    <div class="game-description">
                        <p><?php echo nl2br(htmlspecialchars($game['description'])); ?></p>
                    </div>
                    <div class="detail-item">
                        <h3>Developer</h3>
                        <p><?php echo htmlspecialchars($game['developer']); ?></p>
                    </div>
                    <div class="detail-item">
                        <h3>Release Year</h3>
                        <p><?php echo htmlspecialchars($game['release_year']); ?></p>
                    </div>
                    <div class="detail-item">
                        <h3>Genre</h3>
                        <p><?php echo htmlspecialchars($game['genre']); ?></p>
                    </div>
                    <div class="purchase-section">
                        <div class="price-tag">$<?php echo number_format($game['price'], 2); ?></div>
                        <a href="place_order.php?game_id=<?php echo $game['id']; ?>" class="purchase-button">Purchase Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
