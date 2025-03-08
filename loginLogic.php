<?php
session_start();

include_once('config.php');

if (isset($_POST["submit"])) {
    // Check if 'username' and 'password' are set in POST data
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if any fields are empty
    if (empty($username) || empty($password)) {
        echo "Please fill all the fields.";
    } else {
        // SQL query to check if the user exists
        $sql = "SELECT id, name, username, email, password, confirm_password, is_admin, username FROM users WHERE username = :username";
        
        // Prepare the SQL query
        $selectUsers = $conn->prepare($sql);
        $selectUsers->bindParam(":username", $username);
        
        // Execute the query
        $selectUsers->execute();

        // Fetch user data
        $data = $selectUsers->fetch();

        // Check if user exists
        if ($data == false) {
            echo "The user does not exist";
        } else {
            // Check if password is correct
            if (password_verify($password, $data["password"])) {
                // Set session variables
                $_SESSION['id'] = $data['id'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['is_admin'] = $data['is_admin'];

                // Redirect to dashboard
                header('Location: dashboard.php');
                exit;  // Ensure no further code is executed after the redirect
            } else {
                echo "The password is not valid";
            }
        }
    }
}
?>
