<?php
include 'db_connect.php';

// Get booking parameters from the URL
$room_id = $_GET['room_id'];
$hotel_id = $_GET['hotel_id'];
$check_in_date = $_GET['check_in'];
$check_out_date = $_GET['check_out'];
$guests = $_GET['guests'];

// Fetch room details
$room_sql = "SELECT * FROM rooms WHERE id = $room_id";
$room_result = $conn->query($room_sql);
$room = $room_result->fetch_assoc();

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guest_name = $_POST['guest_name'];
    $email = $_POST['email'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (hotel_id, room_id, guest_name, check_in_date, check_out_date, num_guests, email) 
            VALUES ('$hotel_id', '$room_id', '$guest_name', '$check_in_date', '$check_out_date', '$guests', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Booking successful! A confirmation email has been sent.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="search.php">Search</a></li>
        </ul>
    </nav>
</header>

<section id="booking-form">
    <h1>Book Room at <?php echo $room['room_type']; ?> in <?php echo $room['price']; ?></h1>
    
    <form method="POST">
        <label for="guest_name">Your Name:</label>
        <input type="text" id="guest_name" name="guest_name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Confirm Booking</button>
    </form>
</section>

</body>
</html>

<?php $conn->close(); ?>
