<?php

include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id']; 

       
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
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 350px;
            padding: 40px;
            background: linear-gradient(135deg, rgba(82, 74, 74, 0.21), rgba(240, 240, 240, 0.9));
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        form {
            margin: 0;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            font-size: 16px;
        }

        input:focus {
            border-color:rgb(0, 0, 0);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg,rgb(0, 0, 0),rgb(0, 0, 0));
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:hover {
            background: linear-gradient(45deg,rgb(80, 73, 73),rgb(61, 54, 54));
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
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
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>