
<?php 
 /*Creating a session  based on a session identifier, passed via a GET or POST request.
  We will include config.php for connection with database.
  */

	session_start();

	include_once('config.php');

	if (!isset($_SESSION['id']) || !isset($_SESSION['car_id'])) {
		die('Session variables are not set. Please log in again.');
	}

	//Getting values 'id' and 'movie_id' using $_SESSION
	$user_id = $_SESSION['id'];
    $car_id = $_SESSION['car_id'];

	if (!isset($_POST['nr_tickets'], $_POST['date'], $_POST['time'])) {
		die('Form data is missing. Please complete the form and submit again.');
	}

	//Getting some of data from details.php form
	$price = $_POST['price'];
	$date = $_POST['date'];
	//Inserting the new data into database
	$sql = "INSERT INTO bookings(user_id, car_id, price, date) VALUES (:user_id, :car_id, :price, :date)";

	$insertBooking = $conn->prepare($sql);

	$insertBooking->bindParam(":user_id", $user_id);
	$insertBooking->bindParam(":movie_id", $movie_id);
	$insertBooking->bindParam(":price", $price);
	$insertBooking->bindParam(":date", $date);

	$insertBooking->execute();

	header("Location: home.php");

 ?>
