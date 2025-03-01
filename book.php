<?php

session_start();
include_once('config.php');


if (!isset($_SESSION['id']) || !isset($_SESSION['movie_id'])) {

    die('session variables are not. Please log in again.');
}

$user_id = $_SESSION['id'];
$movie_id = $_SESSION['movie_id'];

if (!isset($_POST['nr_tickets'],$_POST['date'],$_POST['time'])) {

    die('form data is missing. please complete the form and submit again');
}


$nr_tickets = $_POST['nr_tickets'];
$data = $_POST['date'];
$time = $_POST['time'];

$sql = "INSERT INTO bookings (user_id, movie_id, nr_tickets,data,time ) VALUES(:user_id, :movie_id, :nr_tickets :data, :time)";


$insertBooking = $conn->prepare($sql);

$insertSql->bindParam(":user_id",$user_id); 
$insertSql->bindParam(":movie_id",$movie_id);
$insertSql->bindParam(": nr_tickets",$nr_tickets);
$insertSql->bindParam("data",$data);
$insertSql->bindParam(":time",$time);

$insertBooking->execute();

header("Location: home.php");






?>
