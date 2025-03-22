<?php
include 'db_connect.php';

// Get search parameters from the form
$location = $_GET['location'] ?? '';
$check_in_date = $_GET['check_in_date'] ?? '';
$check_out_date = $_GET['check_out_date'] ?? '';
$guests = $_GET['guests'] ?? 1;

// SQL query to find hotels based on search parameters
$sql = "SELECT * FROM hotels WHERE location LIKE '%$location%'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search Results</title>
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

<section id="search-results">
    <h1>Hotel Search Results</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hotel_id = $row['id'];
            echo '<div class="hotel-item">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<p>Location: ' . $row['location'] . '</p>';

            // Fetch rooms available for this hotel
            $room_sql = "SELECT * FROM rooms WHERE hotel_id = $hotel_id AND availability = 1";
            $room_result = $conn->query($room_sql);

            if ($room_result->num_rows > 0) {
                while ($room = $room_result->fetch_assoc()) {
                    echo '<p>Room Type: ' . $room['room_type'] . '</p>';
                    echo '<p>Price: $' . $room['price'] . ' per night</p>';
                    echo '<a href="book.php?room_id=' . $room['id'] . '&hotel_id=' . $hotel_id . '&check_in=' . $check_in_date . '&check_out=' . $check_out_date . '&guests=' . $guests . '">Book Now</a>';
                }
            } else {
                echo '<p>No rooms available for your dates.</p>';
            }
            echo '</div>';
        }
    } else {
        echo '<p>No hotels found for this location.</p>';
    }
    ?>
</section>

</body>
</html>

<?php $conn->close(); ?>