<?php
session_start();
include('config.php');

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check the credentials
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Auto Ajsy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    Welcome to Auto Ajsy
</header>

    
    <!-- Display error message if login fails -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    

<div class="container">
    <form method="post">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">

        <!-- "Already have an account?" Sign Up link -->
        <div class="signup-link">
            <p>Already have an account? <a href="register.php">Sign Up</a></p>
        </div>
    </form>
</div>

<footer>
    <p>&copy; 2025 Auto Ajsy</p>
</footer>

</body>
</html>
