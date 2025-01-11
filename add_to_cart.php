<?php
include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $sql = "SELECT * FROM cart WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;
        $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE product_id = $product_id";
        $conn->query($update_sql);
    } else {
     
        $insert_sql = "INSERT INTO cart (product_id, quantity) VALUES ($product_id, 1)";
        $conn->query($insert_sql);
    }

    
    header("Location")}