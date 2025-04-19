<?php

  include_once('config.php');
  session_start();

  
  if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE id = :id"; 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $car_id, PDO::PARAM_INT);
    $stmt->execute();
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {

    header("Location: list_cars.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Car Sales Dashboard</a>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="logout.php">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <img src="images/<?php echo htmlspecialchars($car['car_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['car_name']); ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($car['car_name']); ?> (<?php echo htmlspecialchars($car['car_model']); ?>)</h5>
            <p class="card-text"><?php echo htmlspecialchars($car['car_desc']); ?></p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Make: <?php echo htmlspecialchars($car['car_make']); ?></li>
              <li class="list-group-item">Mileage: <?php echo htmlspecialchars($car['car_mileage']); ?> km</li>
              <li class="list-group-item">Price: $<?php echo htmlspecialchars(number_format($car['car_price'], 2)); ?></li>
            </ul>
            <a href="buy.php?id=<?php echo $car['id']; ?>" class="btn btn-primary mt-3">Buy Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <h2>Car Information</h2>
        <p><strong>Car Name:</strong> <?php echo htmlspecialchars($car['car_name']); ?></p>
        <p><strong>Car Make:</strong> <?php echo htmlspecialchars($car['car_make']); ?></p>
        <p><strong>Car Model:</strong> <?php echo htmlspecialchars($car['car_model']); ?></p>
        <p><strong>Mileage:</strong> <?php echo htmlspecialchars($car['car_mileage']); ?> km</p>
        <p><strong>Price:</strong> $<?php echo htmlspecialchars(number_format($car['car_price'], 2)); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($car['car_desc']); ?></p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
