<?php
// delete_games.php - Delete a game
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    
    $stmt = $pdo->prepare("DELETE FROM games WHERE id=?");
    $stmt->execute([$id]);
    echo "Game deleted successfully.";
}
?>