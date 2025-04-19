<?php
  session_start();
  include_once('config.php');

  if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
  }

  $userId = $_SESSION['user_id'];

  // Fetch the list of purchased cars for the logged-in user
  $sql = "SELECT b.id, c.car_name, c.car_model, b.car_price, b.purchase_date 
          FROM buying b 
          INNER JOIN cars c ON b.car_id = c.id 
          WHERE b.user_id = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $userId);
  $stmt->execute();
  $buyings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Purchased Cars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to your car purchase history, ".$_SESSION['username']; ?></a>
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
            <a class="nav-link" href="buy.php">Buy Car</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="buyings.php">My Purchases</a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Your Purchased Cars</h2>
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Car Name</th>
            <th>Car Model</th>
            <th>Price</th>
            <th>Purchase Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($buyings as $purchase): ?>
            <tr>
              <td><?php echo htmlspecialchars($purchase['car_name']); ?></td>
              <td><?php echo htmlspecialchars($purchase['car_model']); ?></td>
              <td><?php echo "$" . number_format($purchase['car_price'], 2); ?></td>
              <td><?php echo $purchase['purchase_date']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
