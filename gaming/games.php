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
$sql = "SELECT username FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <h1>Games Platform</h1>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="leaderboard.php">Leaderboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <section>
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
    </section>
    
    <section>
        <h3>Available Games</h3>
        <table>
            <tr>
                <th>Game Name</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT id, game_name, genre, rating FROM games";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['game_name']}</td>
                        <td>{$row['genre']}</td>
                        <td>{$row['rating']}</td>
                        <td><a href='game_details.php?id={$row['id']}'>View</a></td>
                      </tr>";
            }
            ?>
        </table>
    </section>
    
</body>
</html>
<?php $conn->close(); ?>
