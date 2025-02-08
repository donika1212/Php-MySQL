<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products List</title>

    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr, td, th {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

    <?php 
        include_once('config.php');

        $getProducts = $conn->prepare("SELECT * FROM products");
        $getProducts->execute();
        $products = $getProducts->fetchAll();
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <?php 
        foreach ($products as $product) {
        ?>
        <tr> 
            <td> <?= $product['id'] ?> </td>
            <td> <?= $product['title'] ?> </td>
            <td> <?= $product['description'] ?> </td> 
            <td> <?= $product['quantity'] ?> </td> 
            <td> <?= $product['price'] ?> </td>
            <td> 
                <?= "<a href='delete.php?id=$product[id]'>Delete</a> | <a href='edit.php?id=$product[id]'>Update</a>" ?>
            </td>
        </tr>
        <?php 
        }
        ?>
    </table>

    <a href="index.php">Add Product</a>

</body>
</html>
