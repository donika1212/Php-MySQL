<?php 
  // Starting the session to access session variables
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar Section -->
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo "Welcome to the Dashboard, " . $_SESSION['username']; ?></a>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="logout.php">Sign out</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar Section -->
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <?php if ($_SESSION['is_admin'] == 'true') { ?>
              <li class="nav-item">
                <a class="nav-link" href="home.php">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="list_cars.php">
                  Cars
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="buyings.php">
                Buying
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content Section -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Welcome to the Car Sales Dashboard</h1>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Cars Available</h5>
                <p class="card-text">Manage the available cars for sale.</p>
                <a href="list_cars.php" class="btn btn-primary">View Cars</a>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Buyings</h5>
                <p class="card-text">Manage car buying records and customer orders.</p>
                <a href="buyings.php" class="btn btn-primary">View Buyings</a>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
