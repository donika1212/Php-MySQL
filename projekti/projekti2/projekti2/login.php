<?php
// login.php - User login
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id']; // Storing user_id in session

        // Redirect to the dashboard or orders page after successful login
        header("Location: merree.php");
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Invalid credentials. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('images/backround2.jpg');
            background-size: cover;  /* Ensures the image covers the entire screen */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Makes sure the body is full height of the viewport */
            margin: 0;     /* Removes any default margin */
        }

        .container {
            width: 20%;
            margin: auto;
            padding: 20px;
            background: linear-gradient(to right, #00bcd4, #ff9800); 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            margin-top: 250px;
            transition: all 0.3s ease; 
        }

        .container:hover {
            background: linear-gradient(to right, #ff9800, #00bcd4); 
            transform: scale(1.05);
        }

        h1 {
            color: black;
        }

        form {
            margin: 20px 0;
        }

        input {
            background: linear-gradient(90deg, rgb(228, 48, 48), #ffb6c1); 
            color: #333; 
            width: 100%; 
            box-sizing: border-box; 
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            width: 100%; 
            box-sizing: border-box;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        input:focus {
            border-color: #007bff; 
            outline: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


