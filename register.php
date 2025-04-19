<?php
// Database connection
include('db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if user already exists
    $query = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "Username or Email already exists!";
    } else {
        // Insert new user into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $query)) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - StyleNest</title>
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
            <h2>Register</h2>
            <form action="register.php" method="POST" class="register-form">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Register">
            </form>
        </div>
    </main>
</body>
</html>
