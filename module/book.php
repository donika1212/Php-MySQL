<?php

session_start();
include_once('config.php');


if(isset($_POST["submit"])) || !(isset($_POST["submit"])) {

    die('Session variables are not. Please log in again.');


}



$user_id = $_SESSION['id'];
$movie_id = $_SESSION['movie_id'];


if(isset($_POST["nr_tickets"], $_POST['date'],$_POST['time']))  {

    die('Session variables are not. Please complete the form and sumbit again.');


}


$nr_tickets = $_POST['nr_tickets'];
$date = $_POST['date'];
$time = $_POST['time'];


$sql = "INSERT INTO bookings (user_id, movie_id, nr_ticker, date,time) VALUES (:user_id, :movie_id, :nr_tickets :date, :time)";


$insertBooking = $conn->perpare($sql);

    $insertMovie->bindParam(":user_id",$user_id);
    $insertMovie->bindParam(":movie_id",$movie_id);
    $insertMovie->bindParam(":nr_ticker",$nr_ticker);
    $insertMovie->bindParam(":date",$date);
    $insertMovie->bindParam(":time",$time);


    $insertBooking->execute();

    header("Location: home.php");













?>