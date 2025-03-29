<?php
session_start();

// Check if the user is logged in, if not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
$connection = new mysqli("localhost", "root", "", "shopping_cart");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_shoe'])) {
        $shoeName = $_POST['shoe_name'];
        $shoeSize = $_POST['shoe_size']; // This will now come from the selected square.
        $shoeColor = $_POST['shoe_color'] ?? $_POST['custom_color'];

        // Insert into the database
        $query = "INSERT INTO products (title, colors, size, price, img) VALUES (?, ?, ?, 0, '')";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sss", $shoeName, $shoeColor, $shoeSize);
        $stmt->execute();
        $stmt->close();
        $successMessage = "Product added successfully!";
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .color-option,
        .size-option {
            width: 30px;
            height: 30px;
            border: 2px solid #ddd;
            cursor: pointer;
            display: inline-block;
            margin-right: 10px;
            border-radius: 4px;
            text-align: center;
            line-height: 30px;
        }

        .color-option.selected,
        .size-option.selected {
            border: 2px solid #000;
        }

        .color-option input,
        .size-option input {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#" style="font-weight:bold; color:white;">Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav m-auto mt-2 mt-lg-0">
                <!-- Link to View Products -->
                <li class="nav-item d-flex justify-content-between align-items-center" style="gap: 50px;">
    <a class="nav-link text-white" href="/NIKE-STORE-MAIN/index.php" style="font-weight: bold;">Back to Home</a>
    <a class="nav-link text-white ms-auto" href="view_products.php">View Products</a>
</li>

            </ul>
            <form class="d-flex my-2 my-lg-0">
                <a href="./logout.php" class="btn btn-light my-2 my-sm-0"
                  type="submit" style="font-weight:bolder;color:grey;">
                    Logout</a>
            </form>
        </div>
    </div>
</nav>

    <!-- Welcome Message -->
    <div class="container mt-5">
        <h2 class="p-4">Welcome To Dashboard</h2>

        <!-- Success Message -->
        <?php if (isset($successMessage)) { ?>
            <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
        <?php } ?>

        <!-- Product Creation Form -->
        <div class="card mx-auto mt-4" style="width: 400px; padding: 20px;">
            <div class="card-body">
                <h5 class="card-title text-center">Add a New Shoe</h5>

                <!-- Shoe Form -->
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="shoe_name" class="form-label">Shoe Name</label>
                        <input type="text" class="form-control" id="shoe_name" name="shoe_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shoe Color</label>
                        <div class="d-flex flex-wrap">
                            <label class="color-option" style="background-color: #ff0000;">
                                <input type="radio" name="shoe_color" value="#ff0000">
                            </label>
                            <label class="color-option" style="background-color: #0000ff;">
                                <input type="radio" name="shoe_color" value="#0000ff">
                            </label>
                            <label class="color-option" style="background-color: #00ff00;">
                                <input type="radio" name="shoe_color" value="#00ff00">
                            </label>
                            <label class="color-option" style="background-color: #ff9900;">
                                <input type="radio" name="shoe_color" value="#ff9900">
                            </label>
                            <label class="color-option" style="background-color: #8e44ad;">
                                <input type="radio" name="shoe_color" value="#8e44ad">
                            </label>
                            <label class="color-option" style="background-color: #34495e;">
                                <input type="radio" name="shoe_color" value="#34495e">
                            </label>
                        </div>
                        <!-- Custom Color Picker -->
                        <div class="mt-3">
                            <label for="custom_color" class="form-label">Or Choose a Custom Color:</label><br>
                            <input type="color" name="custom_color" style="margin-left: 10px; width: 40px; height: 30px;" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shoe Size</label>
                        <div class="d-flex flex-wrap">
                            <?php for ($i = 36; $i <= 45; $i++) { ?>
                                <label class="size-option">
                                    <input type="radio" name="shoe_size" value="<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>
                    <button type="submit" name="add_shoe" class="btn btn-primary w-100">Add Shoe</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add "selected" class to the chosen color
        const colorOptions = document.querySelectorAll('.color-option input');
        colorOptions.forEach(option => {
            option.addEventListener('change', function () {
                document.querySelectorAll('.color-option').forEach(el => el.classList.remove('selected'));
                this.parentElement.classList.add('selected');
            });
        });

        // Add "selected" class to the chosen size
        const sizeOptions = document.querySelectorAll('.size-option input');
        sizeOptions.forEach(option => {
            option.addEventListener('change', function () {
                document.querySelectorAll('.size-option').forEach(el => el.classList.remove('selected'));
                this.parentElement.classList.add('selected');
            });
        });
    </script>
</body>

</html>
