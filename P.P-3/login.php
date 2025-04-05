<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password!";
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
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            backdrop-filter: blur(10px);
            margin-bottom: 350px;
        }
        .login-container h2 {
            color: black;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.3);
            color: black;
            outline: none;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
        }
        .input-field::placeholder {
            color: black;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: linear-gradient(to right, rgba(255, 165, 0, 0.8), rgba(0, 123, 255, 0.8));
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-btn:hover {
            background: linear-gradient(to right, rgba(255, 140, 0, 0.9), rgba(0, 102, 204, 0.9));
        }
        .logo{
            margin-bottom: 90px;
        }
    </style>
</head>
<body>
<div class="logo">
        <img src="logo.png" alt="Laberion SHPK Logo" class="logo">
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"> <?php echo $error; ?> </p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" class="input-field" placeholder="Email" required>
            <input type="password" name="password" class="input-field" placeholder="Password" required>
            <button type="submit" name="login" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
