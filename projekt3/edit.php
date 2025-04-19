<?php
  include_once('config.php');
  session_start();

  if ($_SESSION['is_admin'] != 'true') {
    header("Location: dashboard.php"); 
    exit;
  }


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

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_name = $_POST['car_name'];
    $car_make = $_POST['car_make'];
    $car_model = $_POST['car_model'];
    $car_mileage = $_POST['car_mileage'];
    $car_price = $_POST['car_price'];
    $car_desc = $_POST['car_desc'];
    $car_image = $_FILES['car_image']['name'];


    if ($car_image) {
      $target_dir = "images/";
      $target_file = $target_dir . basename($car_image);
      move_uploaded_file($_FILES["car_image"]["tmp_name"], $target_file);
    } else {
      $car_image = $car['car_image']; 
    }

  
    $update_sql = "UPDATE cars SET car_name = :car_name, car_make = :car_make, car_model = :car_model, 
                    car_mileage = :car_mileage, car_price = :car_price, car_desc = :car_desc, 
                    car_image = :car_image WHERE id = :id";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bindParam(':car_name', $car_name);
    $update_stmt->bindParam(':car_make', $car_make);
    $update_stmt->bindParam(':car_model', $car_model);
    $update_stmt->bindParam(':car_mileage', $car_mileage);
    $update_stmt->bindParam(':car_price', $car_price);
    $update_stmt->bindParam(':car_desc', $car_desc);
    $update_stmt->bindParam(':car_image', $car_image);
    $update_stmt->bindParam(':id', $car_id, PDO::PARAM_INT);

    // Execute the update
    if ($update_stmt->execute()) {
      header("Location: list_cars.php"); // Redirect to car list after successful update
      exit;
    } else {
      echo "Error updating car details.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Car</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar Section -->
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Car Sales Dashboard</a>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="logout.php">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container mt-5">
    <h2>Edit Car Details</h2>
    <form action="edit.php?id=<?php echo $car['id']; ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="car_name" class="form-label">Car Name</label>
        <input type="text" class="form-control" id="car_name" name="car_name" value="<?php echo htmlspecialchars($car['car_name']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="car_make" class="form-label">Car Make</label>
        <input type="text" class="form-control" id="car_make" name="car_make" value="<?php echo htmlspecialchars($car['car_make']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="car_model" class="form-label">Car Model</label>
        <input type="text" class="form-control" id="car_model" name="car_model" value="<?php echo htmlspecialchars($car['car_model']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="car_mileage" class="form-label">Mileage (in km)</label>
        <input type="number" class="form-control" id="car_mileage" name="car_mileage" value="<?php echo htmlspecialchars($car['car_mileage']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="car_price" class="form-label">Price ($)</label>
        <input type="number" class="form-control" id="car_price" name="car_price" value="<?php echo htmlspecialchars($car['car_price']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="car_desc" class="form-label">Car Description</label>
        <textarea class="form-control" id="car_desc" name="car_desc" rows="3" required><?php echo htmlspecialchars($car['car_desc']); ?></textarea>
      </div>
      <div class="mb-3">
        <label for="car_image" class="form-label">Car Image</label>
        <input type="file" class="form-control" id="car_image" name="car_image">
        <small class="form-text text-muted">Leave blank to keep the current image.</small>
      </div>
      <button type="submit" class="btn btn-primary">Update Car</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
