<?php
session_start();

// Check if the user is logged in, if not redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
$connection = new mysqli("localhost", "root", "", "shopping_cart");

// Fetch products from the database
$query = "SELECT * FROM products";
$result = $connection->query($query);

// Handle updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $productId = $_POST['product_id'];
        $updatedColor = $_POST['shoe_color'];
        $updatedSize = $_POST['shoe_size'];

        $updateQuery = "UPDATE products SET colors = ?, size = ? WHERE id = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("ssi", $updatedColor, $updatedSize, $productId);

        if ($stmt->execute()) {
            $successMessage = "Product updated successfully!";
        } else {
            $errorMessage = "Failed to update product.";
        }
        $stmt->close();
    }
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $productIdToDelete = $_GET['delete_id'];
    
    // Delete the product from the database
    $deleteQuery = "DELETE FROM products WHERE id = ?";
    $stmt = $connection->prepare($deleteQuery);
    $stmt->bind_param("i", $productIdToDelete);

    if ($stmt->execute()) {
        $deleteMessage = "Product deleted successfully!";
    } else {
        $deleteMessage = "Failed to delete product.";
    }

    $stmt->close();
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="#">View Products</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav m-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <a href="./logout.php" class="btn btn-light my-2 my-sm-0" type="submit" style="font-weight:bolder;color:grey;">
                        Logout</a>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Products List</h2>

        <!-- Success/Error Messages -->
        <?php if (isset($successMessage)) { ?>
            <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
        <?php } ?>
        <?php if (isset($errorMessage)) { ?>
            <div class="alert alert-danger text-center"><?php echo $errorMessage; ?></div>
        <?php } ?>
        <?php if (isset($deleteMessage)) { ?>
            <div class="alert alert-success text-center"><?php echo $deleteMessage; ?></div>
        <?php } ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span><?php echo $row['colors']; ?></span>
                                    <div style="width: 20px; height: 20px; background-color: <?php echo strtolower($row['colors']); ?>; border: 1px solid #ccc;"></div>
                                </div>
                            </td>
                            <td><?php echo $row['size']; ?></td>
                            <td>
                                <!-- Edit Button with Modal -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                                                    <!-- Color Selection -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Color</label>
                                                        <div class="d-flex gap-2">
                                                            <input type="radio" id="color_black<?php echo $row['id']; ?>" name="shoe_color" value="Black" <?php echo $row['colors'] === 'Black' ? 'checked' : ''; ?>>
                                                            <label for="color_black<?php echo $row['id']; ?>" class="color-box" style="background-color: black; width: 30px; height: 30px; border: 1px solid #ccc; cursor: pointer;"></label>

                                                            <input type="radio" id="color_blue<?php echo $row['id']; ?>" name="shoe_color" value="Blue" <?php echo $row['colors'] === 'Blue' ? 'checked' : ''; ?>>
                                                            <label for="color_blue<?php echo $row['id']; ?>" class="color-box" style="background-color: blue; width: 30px; height: 30px; border: 1px solid #ccc; cursor: pointer;"></label>

                                                            <input type="radio" id="color_red<?php echo $row['id']; ?>" name="shoe_color" value="Red" <?php echo $row['colors'] === 'Red' ? 'checked' : ''; ?>>
                                                            <label for="color_red<?php echo $row['id']; ?>" class="color-box" style="background-color: red; width: 30px; height: 30px; border: 1px solid #ccc; cursor: pointer;"></label>
                                                        </div>
                                                    </div>

                                                    <!-- Size Selection -->
                                                    <div class="mb-3">
                                                        <label for="shoe_size<?php echo $row['id']; ?>" class="form-label">Select Size</label>
                                                        <select id="shoe_size<?php echo $row['id']; ?>" name="shoe_size" class="form-select">
                                                            <?php for ($i = 38; $i <= 45; $i++) { ?>
                                                                <option value="<?php echo $i; ?>" <?php echo $row['size'] == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="update" class="btn btn-success">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5" class="text-center">No products found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
