<?php
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_id'], $_POST['new_password'], $_POST['confirm_password'])) {
        $user_id = $_POST['user_id'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

     
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$_SESSION['username']]);
        $currentUserId = $stmt->fetchColumn();

        if (!$currentUserId || ($user_id != $currentUserId && (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1))) {
            $_SESSION['message'] = "You don't have permission to change this password!";
            $_SESSION['message_type'] = "error";
            header("Location: merree.php");
            exit();
        }

     
        if ($new_password !== $confirm_password) {
            $_SESSION['message'] = "Passwords do not match!";
            $_SESSION['message_type'] = "error";
            header("Location: merree.php");
            exit();
        }

     
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($current_password, $user['password'])) {
            $_SESSION['message'] = 'Current password is incorrect!';
            $_SESSION['message_type'] = 'error';
            header("Location: merree.php");
            exit();
        }

      
        if (password_verify($new_password, $user['password'])) {
            $_SESSION['message'] = 'New password cannot be the same as your current password!';
            $_SESSION['message_type'] = 'error';
            header("Location: merree.php");
            exit();

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        try {
          
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            if ($stmt->execute([$hashed_password, $user_id])) {
                $_SESSION['message'] = "Password updated successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error updating password.";
                $_SESSION['message_type'] = "error";
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "Database error: " . $e->getMessage();
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Missing required fields!";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Invalid request method!";
    $_SESSION['message_type'] = "error";
}

header("Location: merree.php");
exit();
?>
