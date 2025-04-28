<?php
session_start();

// Assuming the order was placed successfully, store the message in the session
$_SESSION['order_success'] = "Your order has been placed successfully!";

// Redirect to the home page using JavaScript after 3 seconds
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <script type="text/javascript">
        // Set a timeout of 3 seconds before redirecting
        setTimeout(function() {
            window.location.href = "index.php"; // Redirect to the home page
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure you are including the styles -->
</head>
<body>

    <!-- Success message -->
    <div class="success">
        <?php 
            if (isset($_SESSION['order_success'])) {
                echo $_SESSION['order_success'];
                unset($_SESSION['order_success']); // Clear the message after displaying
            }
        ?>
    </div>

</body>
</html>
