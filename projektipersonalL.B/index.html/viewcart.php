<?php 
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$db = "db"; 

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product']) && isset($_POST['price'])) {
        
        $product = $_POST['product'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("INSERT INTO cart (product_name, price) VALUES (:product_name, :price)");
        $stmt->bindParam(':product_name', $product);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
        
        $_SESSION['message'] = "Item added to cart successfully!";
        header("Location: ../index.html/index.php");
        exit();
    }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_product'])) {
        $productId = $_POST['remove_product'];

        $stmt = $conn->prepare("DELETE FROM cart WHERE id = :id");
        $stmt->bindParam(':id', $productId);
        $stmt->execute();

        $_SESSION['message'] = "Item removed from cart successfully!";
        header("Location: viewcart.php");
        exit();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$conn = null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Cart</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <header>
      <h2>View Cart</h2>
      <div class="links">
        <a href="../index.html/index.php" class="link1">Home</a>
        <a href="../AboutUs/AboutUs.html" class="link2">About Us</a>
        <a href="../ContactUs/contactus.html" class="link3">Contact Us</a>
        <a href="viewcart.php" class="link4">View Cart</a>
        <?php if (isset($_SESSION["username"])) { ?>
          <a href="logout.php" class="link5"><?php echo $_SESSION["username"]; ?>, Logout</a>
        <?php } else { ?>
          <a href="signin.php" class="link5">Sign In</a>
        <?php } ?>
      </div>
  </header>
  
  <main>
    <h3>Items in Your Cart</h3>
    <ul>
      <?php
      $total = 0; 
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $stmt = $conn->query("SELECT id, product_name, price FROM cart");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<li>" . htmlspecialchars($row['product_name']) . " - " . htmlspecialchars($row['price']) . "€";
              echo '<form action="viewcart.php" method="post" style="display:inline;">
                      <input type="hidden" name="remove_product" value="' . $row['id'] . '">
                      <button type="submit" class="btn">Remove</button>
                    </form>';
              echo "</li>";
              

              $total += (float) str_replace(',', '.', $row['price']); 
          }
      } catch (PDOException $e) {
          die("Query failed: " . $e->getMessage());
      }

      $conn = null;
      ?>
    </ul>

    <h3>Total: <?php echo number_format($total, 2, ',', '') . '€'; ?></h3> 
  </main>
  
  <footer>
    <div class="footer-content">
      <p>&copy; Nike Remake by Ron Shala, Digital School</p>
    </div>
  </footer>
</body>
</html>
