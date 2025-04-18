<?php 
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $users = [$currentUser];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('images/backround2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.83);
            padding: 15px;
            margin-bottom: 30px;
            width: 100%;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #4CAF50;
        }

        .container {
            max-width: 900px;
            background: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            margin-top: 80px;
            width: 100%;
        }

        h1 {
            color: #4CAF50;
            margin-top: 0;
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        th {
            background-color: rgba(0, 0, 0, 0.5);
            font-weight: bold;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s, opacity 0.3s;
            margin-right: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-edit {
            background-color: #2196F3;
        }

        .btn-home {
            background-color: #4CAF50;
            margin-bottom: 20px;
            display: inline-block;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-count {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
        }

       
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.9);
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            position: relative;
            color: white;
        }

        .close {
            position: absolute;
            right: 10px;
            top: 5px;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #444;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .success-message {
            background-color: rgba(76, 175, 80, 0.3);
            color: white;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            background-color: rgba(244, 67, 54, 0.3);
            color: white;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h1><?php echo isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 ? 'Account Management' : 'My Account'; ?></h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="<?php echo $_SESSION['message_type']; ?>-message">
                <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>

        <div class="header-actions">
            <a href="dashboard.php" class="btn btn-home">Back to Dashboard</a>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <div class="user-count">
                Total Users: <?php echo count($users); ?>
            </div>
            <?php endif; ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td>
                        <button class="btn btn-edit" onclick="openPasswordModal(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['username']); ?>')">Update Password</button>
                        <?php if ($user['id'] == $currentUser['id'] || (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)): ?>
                        <form method="POST" action="delete_user.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone!');">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-delete"><?php echo $user['id'] == $currentUser['id'] ? 'Delete My Account' : 'Delete User'; ?></button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

   
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePasswordModal()">&times;</span>
            <h2 style="margin-top: 0;">Update Password</h2>
            <form id="passwordForm" method="POST" action="update_password.php">
                <input type="hidden" id="userId" name="user_id">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" id="username" readonly>
                </div>
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-edit" style="width: 100%;">Update Password</button>
            </form>
        </div>
    </div>

    <script>
        function openPasswordModal(userId, username) {
            document.getElementById('passwordModal').style.display = 'block';
            document.getElementById('userId').value = userId;
            document.getElementById('username').value = username;
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').style.display = 'none';
            document.getElementById('passwordForm').reset();
        }

       
        window.onclick = function(event) {
            if (event.target == document.getElementById('passwordModal')) {
                closePasswordModal();
            }
        }

       
        document.getElementById('passwordForm').onsubmit = function(e) {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            
            if (currentPassword === newPassword) {
                alert('New password cannot be the same as your current password!');
                e.preventDefault();
                return false;
            }
            
            if (newPassword !== confirmPassword) {
                alert('Passwords do not match!');
                e.preventDefault();
                return false;
            }
            
            if (newPassword.length < 8) {
                alert('New password must be at least 8 characters long!');
                e.preventDefault();
                return false;
            }
            
            return true;
        };
    </script>
</body>
</html>