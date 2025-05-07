<?php 
session_start();
include_once('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$selectUsers = $pdo->prepare($sql);
$selectUsers->execute();
$users = $selectUsers->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts</title>
    <style>
        body {
    background-image: url('images/background.jpg');
    background-size: cover;  /* Ensures the image covers the entire screen */
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;     /* Ensures the background covers full height of the viewport */
}
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: rgb(255, 255, 255);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color:rgb(0, 0, 0);
            color: white;
        }
        button {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
        .dashboard-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color:rgb(0, 0, 0);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .dashboard-link:hover {
            background-color:rgb(0, 0, 0);
        }
    </style>
   
</head>
<body>
    <div class="container">
        <h1>Account Management</h1>
        <a href="dashboard.php" class="dashboard-link">Go to Home</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>
                    <form method="POST" action="delete_user.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
   
</body>
</html>


