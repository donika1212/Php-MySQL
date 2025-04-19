<?php

echo realpath('config.php');

include_once('config.php');

if (isset($_POST['submit'])) {

    // Get form data
    $emri = $_POST['emri'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $tempPass = $_POST['password'];
    $password = password_hash($tempPass, PASSWORD_DEFAULT);

    $tempConfirm = $_POST['confirm_password'];
    $confirm_password = password_hash($tempConfirm, PASSWORD_DEFAULT);

    // Validate if all fields are filled
    if (empty($emri) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "You have not filled in all the fields.";
    } else {

        // Prepare SQL query to insert data into users table
        $sql = "INSERT INTO users (emri, username, email, password, confirm_password) 
                VALUES (:emri, :username, :email, :password, :confirm_password)";

        // Prepare and execute the SQL statement
        $insertSql = $conn->prepare($sql);

        $insertSql->bindParam(':emri', $emri);
        $insertSql->bindParam(':username', $username);
        $insertSql->bindParam(':email', $email);
        $insertSql->bindParam(':password', $password);
        $insertSql->bindParam(':confirm_password', $confirm_password);

        // Execute the query
        $insertSql->execute();

        // Redirect to the login page after successful signup
        header("Location: login.php");
    }
}
?>
