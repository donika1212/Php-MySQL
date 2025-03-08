<?php 
 /*Creating a session  based on a session identifier, passed via a GET or POST request.
  We will include config.php for connection with database.
  */

	session_start();

	include_once('config.php');

	if (!isset($_SESSION['id']) || !isset($_SESSION['movie_id'])) {
		die('Session variables are not set. Please log in again.');
	}

	//Getting values 'id' and 'movie_id' using $_SESSION
	$user_id = $_SESSION['id'];
    $movie_id = $_SESSION['movie_id'];

	if (!isset($_POST['nr_tickets'], $_POST['date'], $_POST['time'])) {
		die('Form data is missing. Please complete the form and submit again.');
	}

	//Getting some of data from details.php form
	$nr_tickets = $_POST['nr_tickets'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	//Inserting the new data into database
	$sql = "INSERT INTO bookings(user_id, movie_id, nr_tickets, date, time) VALUES (:user_id, :movie_id, :nr_tickets, :date, :time)";

	$insertBooking = $conn->prepare($sql);

	$insertBooking->bindParam(":user_id", $user_id);
	$insertBooking->bindParam(":movie_id", $movie_id);
	$insertBooking->bindParam(":nr_tickets", $nr_tickets);
	$insertBooking->bindParam(":date", $date);
	$insertBooking->bindParam(":time", $time);

	$insertBooking->execute();

	header("Location: home.php");

 ?>