<?php

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim input to prevent unnecessary spaces
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $quantity = trim($_POST['quantity']);
    $price = trim($_POST['price']);

    // Check if any field is empty
    if (empty($title) || empty($description) || empty($quantity) || empty($price)) {
        echo "All fields are required!";
        exit; 
    }

    // Check if title already exists
    $sql = "SELECT title FROM products WHERE title = :title";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Product title already exists!";
        header("refresh:2; url=add_product.php");
        exit;
    }

    // Insert new product into database
    $sql = "INSERT INTO products (title, description, quantity, price) 
            VALUES (:title, :description, :quantity, :price)";
    
    $insertStmt = $conn->prepare($sql);
    $insertStmt->bindParam(':title', $title);
    $insertStmt->bindParam(':description', $description);
    $insertStmt->bindParam(':quantity', $quantity);
    $insertStmt->bindParam(':price', $price);

    if ($insertStmt->execute()) {
        echo "Product added successfully!";
        header("Location: product_list.php");
        exit;
    } else {
        echo "An error occurred. Please try again.";
    }
}
?>
