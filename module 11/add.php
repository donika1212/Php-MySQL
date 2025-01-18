<?php

	include_once('config.php');

	if(isset($_POST['submit']))
	{

	    $username = $_POST['username'];
		$lastname = $_POST['lastname'];


			$sql = "INSERT INTO mytable (username,lastname) VALUES (:username, :lastname)";

			$insertSql = $conn->prepare($sql);

			$insertSql->bindParam(':username', $username);
			$insertSql->bindParam(':lastname', $lastname);

			$insertSql->execute();

			echo "The user has been added successfully";

			echo "<br>";

			echo "<a href='dashboard.php'>Dashboard</a>";

	}


?>