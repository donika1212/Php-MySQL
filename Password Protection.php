
<?php
$admin_password = "admin123"; 
if (!isset($_GET['auth']) || $_GET['auth'] !== $admin_password) {
    die("Unauthorized. Append ?auth=admin123 to the URL to access.");
}
?>
