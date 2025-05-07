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