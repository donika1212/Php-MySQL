<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        echo "<p style='color: red;'>Username already taken!</p>";
    } else {
        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "<p style='color: red;'>Registration failed. Try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            height: 100vh; /* Ensures full height */
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('images/backround register.jpg') no-repeat center center/cover; /* Static background image */
        }

        /* Container Styling */
        .container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: rgba(113, 73, 206, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        /* Heading Styling */
        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Input Field Styling */
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #ff7e5f;
            outline: none;
        }

        /* Button Styling */
        button {
            width: 100%;
            padding: 12px;
            background-color:rgb(175, 53, 231);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #feb47b;
        }

        /* Link Styling */
        a {
            color:rgb(175, 53, 231);
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 15px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #feb47b;
        }

        /* Error message styling */
        p {
            color: red;
            font-size: 1rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Sign Up</button>
        </form>
        <br>
        <a href="login.php">Already have an account? Login here</a>
    </div>

</body>
</html>
