<?php

session_start();
include_once('config.php');



if (!isset($_SESSION['id']) || !isset($_SESSION['movie_id'])) {


    die('Session variable are not. Please log in again.');

}

$user_id = $_SESSION['id'];
$movie_id = $_SESSION['movie_id'];

if(!isset($_POST['nr_tickets'],$_POST['date'],$_POST['time'] )){
    die('form data is missing. Please complete the form and submit again.');

}

$nr_ticket = $_POST['nr_tickets'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "INSERT INTO bookings (user_id, movies_id nr_tickets, data,time) VALUES (:user_id, :movie_id, :nr_tickets :date :time)";




$insertMovie = $conn->prepare($sql);



$insertMovie->bindParam(':movie_id', $user_id);
$insertMovie->bindParam(':movie_id', $movie_id);
$insertMovie->bindParam(':nr_tickets', $nr_ticket);
$insertMovie->bindParam(':date', $date);
$insertMovie->bindParam(':time', $time);

$insertBooking->execute();

header("Location: home.php");







?>