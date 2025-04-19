<?php 

	include_once('config.php');

	if (isset($_POST['submit1'])) {
		$id = $_POST['id'];
		$car_name = $_POST['car_name'];
		$car_desc = $_POST['car_desc'];
		$car_model = $_POST['car_model'];
		$car_mileage = $_POST['car_mileage'];
		$car_price = $_POST['car_price'];

		$sql = "UPDATE cars SET id=:id, car_name=:car_name, car_desc=:car_desc, car_model=:car_model, car_mileage=:car_mileage, car_price=:car_price WHERE id=:id";

		$prep = $conn->prepare($sql);
		$prep->bindParam(':id', $id);
		$prep->bindParam(':car_name', $car_name);
		$prep->bindParam(':car_desc', $car_desc);
		$prep->bindParam(':car_model', $car_model);
		$prep->bindParam(':car_mileage', $car_mileage);
		$prep->bindParam(':car_price', $car_price);
		
		$prep->execute();
		header("Location: dashboard.php");
	}
?>
