<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$stmt = $pdo->prepare("SELECT is_admin FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['is_admin'] = $user['is_admin'] ?? 0;

$stmt = $pdo->query("SELECT DISTINCT * FROM games ORDER BY id LIMIT 12");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
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

        .welcome-section {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), transparent);
        }

        .welcome-section h1 {
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .welcome-section p {
            font-size: 1.2em;
            margin-top: 10px;
            color: #ccc;
        }

        .games {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 30px;
        }

        .game-card {
            background: rgba(30, 30, 30, 0.95);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        .game-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .game-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .game-card h3 {
            margin: 15px 0;
            color: white;
            font-size: 1.4em;
            font-weight: 600;
        }

        .game-card p {
            color: #ccc;
            margin: 10px 0;
            font-size: 1.1em;
        }

        .game-card .price {
            color: #4CAF50;
            font-size: 1.5em;
            font-weight: bold;
            margin: 20px 0;
            text-shadow: 0 0 10px rgba(76, 175, 80, 0.3);
        }

        .game-card a {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg,rgb(203, 241, 113), #1976D2);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .game-card a:hover {
            background: linear-gradient(135deg,rgb(238, 87, 50), #0D47A1);
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.4);
        }

        @media (max-width: 768px) {
            .games {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                padding: 0 20px;
            }
            
            .game-card {
                padding: 15px;
            }
            
            .welcome-section h1 {
                font-size: 2em;
            }
        }

        .feedback-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .feedback-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1001;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            position: relative;
            background: rgba(30, 30, 30, 0.95);
            margin: 10% auto;
            padding: 30px;
            width: 50%;
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 28px;
            cursor: pointer;
            color: #aaa;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: white;
        }

        .feedback-form textarea {
            width: 100%;
            height: 150px;
            margin: 15px 0;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.3);
            color: white;
            font-size: 16px;
            resize: vertical;
        }

        .feedback-form button {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .feedback-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        #feedback-message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        .success {
            background: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
        }

        .error {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="navbar">
            <a href="dashboard.php">Home</a>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <a href="merree.php">Manage Accounts</a>
            <?php endif; ?>
            <a href="view_orders.php">My Orders</a>
            <a href="logout.php">Logout</a>
        </div>

        <button class="feedback-btn" onclick="openFeedbackModal()">Give Feedback</button>

        <div id="feedbackModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeFeedbackModal()">&times;</span>
                <h2>Send us your Feedback</h2>
                <form id="feedback-form" class="feedback-form">
                    <textarea name="feedback" placeholder="Tell us what you think about our game store..." required></textarea>
                    <button type="submit">Send Feedback</button>
                </form>
                <div id="feedback-message"></div>
            </div>
        </div>

        <div class="welcome-section">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Browse our collection and find your next favorite game</p>
        </div>

        <div class="games">
            <?php
            if (empty($games)) {
                echo "<p style='color:white;'>No games found in the database.</p>";
            } else {
                foreach ($games as $game) {
             
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
                        if (stripos(strtolower($game['name']), strtolower($keyword)) !== false) {
                            if (file_exists('images/' . $filename)) {
                                $finalImagePath = 'images/' . $filename;
                                break;
                            }
                        }
                    }
                    ?>
                    <div class="game-card">
                        <img src="<?php echo htmlspecialchars($finalImagePath); ?>" alt="<?php echo htmlspecialchars($game['name']); ?>">
                        <h3><?php echo htmlspecialchars($game['name']); ?></h3>
                        <p><strong>Developer:</strong> <?php echo htmlspecialchars($game['developer']); ?></p>
                        <p class="price">$<?php echo number_format($game['price'], 2); ?></p>
                        <a href="order.php?game_id=<?php echo $game['id']; ?>">Order Now</a>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>

    <script>
      
        function openFeedbackModal() {
            document.getElementById('feedbackModal').style.display = 'block';
        }

        function closeFeedbackModal() {
            document.getElementById('feedbackModal').style.display = 'none';
            document.getElementById('feedback-message').style.display = 'none';
            document.getElementById('feedback-form').reset();
        }

       
        window.onclick = function(event) {
            if (event.target == document.getElementById('feedbackModal')) {
                closeFeedbackModal();
            }
        }

        
        document.getElementById('feedback-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const feedbackText = this.feedback.value;
            const messageDiv = document.getElementById('feedback-message');
            
            fetch('send_feedback.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'feedback=' + encodeURIComponent(feedbackText)
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.textContent = data.message;
                messageDiv.className = data.success ? 'success' : 'error';
                messageDiv.style.display = 'block';
                
                if (data.success) {
                    setTimeout(() => {
                        closeFeedbackModal();
                    }, 2000);
                }
            })
            .catch(error => {
                messageDiv.textContent = 'An error occurred. Please try again.';
                messageDiv.className = 'error';
                messageDiv.style.display = 'block';
            });
        });
    </script>
</body>
</html>
