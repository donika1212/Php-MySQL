<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "User ID not specified.";
    exit;
}

$id = $_GET['id'];

// Fetch user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $updateStmt = $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
    $updateStmt->execute([$email, $password, $id]);

    echo "<script>alert('User updated successfully!'); window.location.href='editUsers.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User - Laberion SHPK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .header {
            background: rgba(255, 140, 0, 0.0);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            position: relative;
        }

        .logo {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            height: 50px;
        }

        .form-container {
            width: 400px;
            margin: 60px auto;
            background: rgba(255, 140, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            color: black;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            backdrop-filter: blur(10px);
            background: rgba(255, 140, 0, 0.3);
        }
        
        input::placeholder{
            color: black;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: linear-gradient(to right, #ff7f00, #007bff);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

    </style>
</head>
<body>

<div class="header">
    <img src="logo.png" alt="Laberion Logo" class="logo">
    Laberion SHPK - Update User
</div>

<div class="form-container">
    <h2>Update User</h2>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>

        <label for="password">New Password:</label>
        <input type="password" name="password" placeholder="Enter new password" required>

        <button type="submit">Update User</button>
    </form>
    <a class="back-btn" href="editUsers.php">← Back to Users</a>
</div>

</body>
</html>
