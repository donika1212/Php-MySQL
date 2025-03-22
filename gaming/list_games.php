<?php
session_start();
include 'config.php'; // Include configuration file

// Database connection

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
            <li><a href="list_games.php">Games</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <section>
        <h2>Available Games</h2>
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
