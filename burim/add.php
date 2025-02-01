<?php

	include_once('config.php');

	if(isset($_POST['submit']))
	{

	    $name = $_POST['name'];
		$age = $_POST['age'];


			$sql = "INSERT INTO users1 (name,age) VALUES (:name, :age)";

			$insertSql = $conn->prepare($sql);

			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':age', $age);

			$insertSql->execute();

			echo "The user has been added successfully";

			echo "<br>";

			echo "<a href='dashboard.php'>Dashboard</a>";

	}


?>