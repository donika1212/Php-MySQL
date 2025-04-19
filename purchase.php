
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $customer_name = $_POST['customer_name'];

    $insert_customer = mysqli_query($conn, "INSERT INTO customers (name) VALUES ('$customer_name')");
    $customer_id = mysqli_insert_id($conn);
    
    $insert_order = mysqli_query($conn, "INSERT INTO orders (product_id, customer_id) VALUES ($product_id, $customer_id)");
    
    echo "Thank you for your purchase, $customer_name!";
}
?>
