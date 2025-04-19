<?php 
 
  session_start();
  include_once('config.php');
  
  if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit();
  }

  $userId = $_SESSION['user_id'];
  
  if (isset($_POST['submit'])) {
    $carId = $_POST['car_id'];
    $userId = $_SESSION['user_id'];
    $carPrice = $_POST['car_price'];
    $carModel = $_POST['car_model'];
    $purchaseDate = date("Y-m-d");

    $sql = "INSERT INTO buying (user_id, car_id, car_price, car_model, purchase_date) VALUES (:user_id, :car_id, :car_price, :car_model, :purchase_date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':car_id', $carId);
    $stmt->bindParam(':car_price', $carPrice);
    $stmt->bindParam(':car_model', $carModel);
    $stmt->bindParam(':purchase_date', $purchaseDate);

    if ($stmt->execute()) {
        echo "Car purchased successfully!";
    } else {
        echo "There was an error with your purchase.";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Purchase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to the car purchase section, ".$_SESSION['username']; ?></a>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="logout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="buy.php">Buy Car</a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Buy Car</h2>

      <form action="buy.php" method="post">
        <div class="form-floating">
          <input type="number" class="form-control" id="car_id" name="car_id" placeholder="Car ID" required>
          <label for="car_id">Car ID</label>
        </div>

        <div class="form-floating">
          <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Car Model" required>
          <label for="car_model">Car Model</label>
        </div>

        <div class="form-floating">
          <input type="number" class="form-control" id="car_price" name="car_price" placeholder="Car Price" required>
          <label for="car_price">Car Price</label>
        </div>

        <button type="submit" name="submit" class="w-100 btn btn-lg btn-primary">Complete Purchase</button>
      </form>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
