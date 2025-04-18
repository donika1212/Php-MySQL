<?php
session_start();
include 'config.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $currentUserId = $stmt->fetchColumn();

    if (!$currentUserId || ($user_id != $currentUserId && (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1))) {
        $_SESSION['message'] = "You don't have permission to delete this account!";
        $_SESSION['message_type'] = "error";
        header("Location: merree.php");
        exit();
    }


    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && $user_id == $currentUserId) {
        $_SESSION['message'] = "Admin accounts cannot be deleted!";
        $_SESSION['message_type'] = "error";
        header("Location: merree.php");
        exit();
    }

    try {
        
        $pdo->beginTransaction();

      
        $stmt = $pdo->prepare("DELETE FROM orders WHERE user_id = ?");
        $stmt->execute([$user_id]);

     
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);

        $pdo->commit();

    
        if ($user_id == $currentUserId) {
            session_destroy();
            header("Location: login.php");
            exit();
        }

        $_SESSION['message'] = "Account deleted successfully!";
        $_SESSION['message_type'] = "success";

    } catch (PDOException $e) {
      
        $pdo->rollBack();
        $_SESSION['message'] = "Error deleting account: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Invalid request!";
    $_SESSION['message_type'] = "error";
}

header("Location: merree.php");
exit();
?>
