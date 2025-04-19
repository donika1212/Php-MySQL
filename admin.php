
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - StyleNest</title>
    <link rel="stylesheet" href="styleeee.css">
</head>
<body>
    <h1>Admin Panel - Manage Products</h1>

    <!-- Add Product Form -->
    <h2>Add New Product</h2>
    <form action="admin.php" method="post">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="image" placeholder="Image Filename (e.g., clothes4.jpg)" required>
        <input type="submit" name="add_product" value="Add Product">
    </form>

    <?php
    // Handle Add Product
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
        mysqli_query($conn, $query);
        echo "<p style='color:green;'>Product added!</p>";
    }

    // Handle Delete Product
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM products WHERE id=$id");
        echo "<p style='color:red;'>Product deleted!</p>";
    }
    ?>

    <!-- Display Existing Products -->
    <h2>Existing Products</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['name']}</td>
                <td>\${$row['price']}</td>
                <td><img src='images/{$row['image']}' height='50'></td>
                <td><a href='admin.php?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
            </tr>
            ";
        }
        ?>
    </table>
</body>
</html>
