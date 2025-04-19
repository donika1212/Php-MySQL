<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Users - Laberion SHPK</title>
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

        .container {
            width: 80%;
            margin: 40px auto;
            background: rgba(255, 140, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.5);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            font-family: Arial Black, Arial Bold, Gadget, sans-serif;
        }

        th {
            background-color: rgb(5, 66, 158);
            color: white;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .edit-btn {
            background-color: rgb(7, 33, 151);
            border-radius: 30px;
        }

        .delete-btn {
            background-color:rgb(128, 2, 14);
            border-radius: 30px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            background: linear-gradient(to right, rgba(255, 165, 0, 0.8), rgba(0, 123, 255, 0.8));
        }
    </style>
</head>
<body>

<div class="header">
    Laberion SHPK - Manage Users
</div>

<div class="container">
    <h2>User List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td>
                <a class="btn edit-btn" href="updateUsers.php?id=<?= $user['id']; ?>">Edit</a>
                <a class="btn delete-btn" href="deleteusers.php?id=<?= $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
