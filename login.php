<?php
// Database connection
include('db.php');

// Start session to handle user login
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to index.html
            header('Location: index.html');
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StyleNest</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>StyleNest Clothing</h1>
            <nav>
                <a href="index.html">Home</a>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            </nav>
        </div>
    </header>
    
    <main class="main-content">
        <div class="container">
            <h2>Login</h2>
            <form action="login.php" method="POST" class="login-form">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </main>
</body>
</html>
