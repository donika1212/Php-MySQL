<?php


session_start();
include_once('config.php');

if(!isset($_SESSION['id']) || !isset($_SESSION['movie_id']) ){
    die('Session variables are not. Please log in again');
}

$user_id = $_SESSION['id'];
$movie_id = $_SESSION['movie_id'];

if (!isset($_POST['nr_tickets'],$_POST ['date'],$_POST['time'])) {
    die('From data is missing. Please complete the form and sumbit againg.');
}


$nr_tickets = $_POST['nr_tickets'];
$data = $_POST['date'];
$time = $_POST['time'];

$sql = "INSERT INTO bookings (user_id, movie_id, nr_tickets, date,time) VALUES (:user_id, :movie_id, :nr_tickets:date, :time)";


$insertBookings = $conn->perpare($sql);

$insertBookings->bindParam(':user_id', $user_id);
$insertBookings->bindParam(':movie_id', $move_id);
$insertBookings->bindParam(':nr_tickets', $nr_tickets);
$insertBookings->bindParam(':date', $date);
$insertBookings->bindParam(':time', $time);

$insertBookings->execute();
header("Location: home.php");






?>