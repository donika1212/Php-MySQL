<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $developer = $_POST['developer'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    
    $stmt = $pdo->prepare("INSERT INTO games (name, developer, release_year, genre, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $developer, $release_year, $genre, $price]);
    echo "Game added successfully.";
}

try {
    
    $games = [
        ['Cyberpunk 2077', 'CD Projekt Red', 59.99],
        ['Elden Ring', 'FromSoftware', 59.99],
        ['Red Dead Redemption 2', 'Rockstar Games', 49.99],
        ['The Witcher 3', 'CD Projekt Red', 39.99],
        ['God of War', 'Santa Monica Studio', 49.99],
        ['Minecraft', 'Mojang', 29.99],
        ['Call of Duty: Modern Warfare', 'Infinity Ward', 59.99],
        ['Assassins Creed Valhalla', 'Ubisoft', 49.99],
        ['Spider-Man', 'Insomniac Games', 49.99],
        ['Resident Evil 4 Remake', 'Capcom', 59.99]
    ];

   
    $stmt = $pdo->prepare("INSERT INTO games (name, developer, price) VALUES (?, ?, ?)");

    
    foreach ($games as $game) {
        $stmt->execute($game);
    }

    echo "Games added successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


header("Location: dashboard.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            margin: 20px 0;
        }
        input, button {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Game</h1>
        <form method="POST" action="add_games.php">
            <input type="text" name="name" placeholder="Game Name" required><br>
            <input type="text" name="developer" placeholder="Developer" required><br>
            <input type="number" name="release_year" placeholder="Release Year" required><br>
            <input type="text" name="genre" placeholder="Genre" required><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br>
            <button type="submit">Add Game</button>
        </form>
    </div>
</body>
</html>