<?php 

	include_once('config.php');

	if (isset($_POST['submit1'])) {
		$id = $_POST['id'];
		$emri = $_POST['emri'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		// Check if new password is provided
		if (!empty($_POST['password'])) {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		} else {
			// If password is not provided, keep the old password
			$password = $_POST['old_password'];
		}

		$sql = "UPDATE users SET emri=:emri, username=:username, email=:email, password=:password WHERE id=:id";

		$prep = $conn->prepare($sql);
		$prep->bindParam(':id', $id);
		$prep->bindParam(':emri', $emri);
		$prep->bindParam(':username', $username);
		$prep->bindParam(':email', $email);
		$prep->bindParam(':password', $password);

		$prep->execute();
		header("Location: dashboard.php");
	}
?>
