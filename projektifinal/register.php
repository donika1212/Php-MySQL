<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);
    header('Location: login.php');
}
?>

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<!-- Ensure the whole page takes at least full height -->
<div class="container">
    <header>
        Welcome to Auto Ajsy
    </header>

    <h1>Sign Up</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>

    <!-- Add the 'Already have an account' link -->
    <div class="already-have-account">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <!-- Footer should stick to the bottom -->
    <footer>
        <p>&copy; 2025 Auto Ajsy</p>
    </footer>
</div>

