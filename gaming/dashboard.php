<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'mms';
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, role FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Platform Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <h1>Games Platform</h1>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="leaderboard.php">Leaderboard</a></li>
            <li><a href="friends.php">Friends</a></li>
            <li><a href="recent_matches.php">Recent Matches</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <section>
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>Role: <?php echo ucfirst($user['role']); ?></p>
    </section>
    
    <section>
        <h3>Game Stats</h3>
        <table>
            <tr>
                <th>Game</th>
                <th>Score</th>
                <th>Rank</th>
            </tr>
            <?php
            $sql = "SELECT game_name, score, rank FROM game_stats WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['game_name']}</td><td>{$row['score']}</td><td>{$row['rank']}</td></tr>";
            }
            ?>
        </table>
    </section>
    
    <section>
        <h3>Friends List</h3>
        <ul>
            <?php
            $sql = "SELECT friend_name FROM friends WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['friend_name']}</li>";
            }
            ?>
        </ul>
    </section>
    
    <section>
        <h3>Recent Matches</h3>
        <table>
            <tr>
                <th>Game</th>
                <th>Opponent</th>
                <th>Result</th>
            </tr>
            <?php
            $sql = "SELECT game_name, opponent, result FROM recent_matches WHERE user_id = '$user_id' ORDER BY match_date DESC LIMIT 5";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['game_name']}</td><td>{$row['opponent']}</td><td>{$row['result']}</td></tr>";
            }
            ?>
        </table>
    </section>
    
</body>
</html>
<?php $conn->close(); ?>
