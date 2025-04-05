<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "db"; 


if (isset($_POST['product']) && isset($_POST['price'])) {
    $product = $_POST['product'];
    $price = $_POST['price'];

    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $conn->prepare("UPDATE products SET price = :price WHERE product_name = :product");
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':product', $product);


        $stmt->execute();

        
        echo "Price updated successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid input!";
}
?>
