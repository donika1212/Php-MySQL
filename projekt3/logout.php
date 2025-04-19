<?php 
// We will destroy all of the data associated with the current session
session_start();

include_once('config.php');

// Destroy the session to log the user out
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit;
?>
