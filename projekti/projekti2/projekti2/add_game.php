<?php
session_start();
include 'config.php';

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $developer = trim($_POST['developer']);
    $release_year = trim($_POST['release_year']);
    $genre = trim($_POST['genre']);
    $price = trim($_POST['price']);
    $image = $_FILES['image']['name']; // Get the uploaded image file name
    $image_tmp = $_FILES['image']['tmp_name']; // Get the temporary file location

    // Check if the image was uploaded
    if (!empty($image)) {
        // Define the target path for the image
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image_tmp, $target_file)) {
            // Image upload successful
        } else {
            echo "<p style='color: red;'>Error uploading image. Please try again.</p>";
        }
    } else {
        echo "<p style='color: red;'>Image is required.</p>";
    }

    // Insert the new game into the database
    if (!empty($name) && !empty($developer) && !empty($release_year) && !empty($genre) && !empty($price) && !empty($image)) {
        $stmt = $pdo->prepare("INSERT INTO games (name, developer, release_year, genre, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $developer, $release_year, $genre, $price, $target_file])) {
            echo "<p style='color: green;'>Game added successfully!</p>";
        } else {
            echo "<p style='color: red;'>Failed to add the game. Please try again.</p>";
        }
    } else {
        echo "<p style='color: red;'>Please fill in all the fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }
        h2 {
            color: #333;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add New Game</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Game Name" required><br>
            <input type="text" name="developer" placeholder="Developer" required><br>
            <input type="number" name="release_year" placeholder="Release Year" required><br>
            <input type="text" name="genre" placeholder="Genre" required><br>
            <input type="number" name="price" placeholder="Price" step="0.01" required><br>
            <input type="file" name="image" accept="image/*" required><br>
            <button type="submit">Add Game</button>
        </form>
    </div>

    <div class="games-list">
        <h2>Games List</h2>
        <div class="games">
            <?php
                // Fetch all games from the database
                $stmt = $pdo->query("SELECT * FROM games");
                $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($games as $game) {
                    echo '<div class="game-card">';
                    echo '<img src="' . htmlspecialchars($game['image_path']) . '" alt="' . htmlspecialchars($game['name']) . '" />';
                    echo '<h3>' . htmlspecialchars($game['name']) . '</h3>';
                    echo '<p>Price: $' . htmlspecialchars($game['price']) . '</p>';
                    echo '<a href="order.php?game_id=' . $game['id'] . '"><button class="order-btn">Order Now</button></a>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

</body>
</html>
