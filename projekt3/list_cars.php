<?php
include_once('config.php');

// Fetch all cars from the database
$sql = "SELECT * FROM cars";
$query = $conn->prepare($sql);
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1 class="mt-5">List of Cars</h1>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Car Name</th>
                <th>Car Make</th>
                <th>Car Model</th>
                <th>Mileage (km)</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['car_name']); ?></td>
                    <td><?php echo htmlspecialchars($car['car_make']); ?></td>
                    <td><?php echo htmlspecialchars($car['car_model']); ?></td>
                    <td><?php echo htmlspecialchars($car['car_mileage']); ?> km</td>
                    <td><?php echo htmlspecialchars($car['car_price']); ?> $</td>
                    <td><?php echo htmlspecialchars($car['car_desc']); ?></td>
                    <td>
                        <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_car.php?id=<?php echo $car['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this car?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQsC8ga3AyZ1A1gAfwGb5psNlP5a2Rh66gPFF7DOAZl1azYRh0IlFekkmS1Tt8tB" crossorigin="anonymous"></script>
</body>
</html>
