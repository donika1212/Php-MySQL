<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nike Page</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .products {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .product {
      width: 30%;
      text-align: center;
      margin-bottom: 20px;
    }

    .product img {
      width: 80px;
      height: 80px;
      object-fit: contain;
    }

    .price-button {
      background: none;
      border: none;
      color: inherit;
      font-size: inherit;
      cursor: pointer;
      padding: 0;
    }
  </style>
  <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
    <script>
      function updatePrice(product, currentPriceElement) {
        let newPrice = prompt("Enter the new price:", currentPriceElement.innerText.replace('€', '').trim());
        if (newPrice && !isNaN(newPrice)) {
          let xhr = new XMLHttpRequest();
          xhr.open("POST", "update_price.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              currentPriceElement.innerText = newPrice + '€';
            }
          };
          xhr.send("product=" + encodeURIComponent(product) + "&price=" + encodeURIComponent(newPrice));
        }
      }
    </script>
  <?php } ?>
</head>

<body>
  <header>
    <div class="navbar" style="display: flex;">
      <img src="https://1000logos.net/wp-content/uploads/2021/11/Nike-Logo.png" alt="logo" class="brand_logo" style="width: 100px;">
      <div class="links">
        <a href="../index.html/index.php" class="link1">Home</a>
        <a href="../AboutUs/AboutUs.html" class="link2">About Us</a>
        <a href="../ContactUs/contactus.html" class="link3">Contact Us</a>
        <a href="../index.html/viewcart.php" class="link4">View Cart</a>
        <?php if (isset($_SESSION["username"])) { ?>
          <a href="logout.php" class="link5"><?php echo $_SESSION["username"]; ?>, Logout</a>
        <?php } else { ?>
          <a href="signin.php" class="link5">Sign In</a>
        <?php } ?>
      </div>
    </div>
  </header>
  <main>
    <div class="Welcome">
      <h3>Welcome to Nike</h3>
      <p>Explore our latest collection</p>
      <a href="#" class="btn">Shop Now</a>
    </div>

    <h2 style="text-align:center; font-size: 20px;">New Dunks To Discover</h2>
    <div class="products">
      <div class="product">
        <img src="images/kobe4protro.png" alt="Product 1">
        <h3>Kobe 4 Protro</h3>
        <p>Mens Shoes</p>
        <button class="price-button"
          <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
          onclick="updatePrice('Kobe 4 Protro', this)"
          <?php } ?>>165,00€</button><br>
        <a href="details.php?product=Kobe%204%20Protro" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/airjordan3retro.png" alt="Product 2">
        <h3>Air Jordan 3 Retro</h3>
        <p>Mens Shoes</p>
        <button class="price-button"
          <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
          onclick="updatePrice('Air Jordan 3 Retro', this)"
          <?php } ?>>173,93€</button><br>
        <a href="details.php?product=Air%20Jordan%203%20Retro" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/blazermid77.png" alt="Product 3">
        <h3>Nike Blazer Mid'77</h3>
        <p>Womens Shoes</p>
        <button class="price-button"   <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
          onclick="updatePrice('Nike Blazer Mid'77', this)"
          <?php } ?>>100,00€</button><br>
        <a href="details.php?product=Nike%20Blazer%20Mid'77" class="btn">More Details</a>
      </div>
    </div>

    <h2 style="text-align:center; font-size: 20px;">Discover New Football Cleats!</h2>
    <div class="products">
      <div class="product">
        <img src="images/vaporedge360dt.png" alt="Product 4">
        <h3>Nike Vapor Edge 360 DT</h3>
        <p>Cleats</p>
        <button class="price-button"   
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Vapor Edge 360 DT', this)" #
        <?php } ?>>195,00€</button><br>
        <a href="details.php?product=Nike%20Vapor%20Edge%20360%20DT" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/vaporedgepro360.png" alt="Product 5">
        <h3>Nike Vapor Edge Pro 360</h3>
        <p>Cleats</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Vapor Edge Pro 360', this)" <?php } ?>>173,93€</button><br>
        <a href="details.php?product=Nike%20Vapor%20Edge%20Pro%20360" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/NikeAlphaMenaceElite3.png" alt="Product 6">
        <h3>Nike Alpha Menace Elite 3</h3>
        <p>Cleats</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Alpha Menace Elite 3', this)"<?php } ?>>198,00€</button><br>
        <a href="details.php?product=Nike%20Alpha%20Menace%20Elite%203" class="btn">More Details</a>
      </div>
    </div>

    <h2 style="text-align:center; font-size: 20px;">Discover New Football Kits!</h2>
    <div class="products">
      <div class="product">
        <img src="images/sonheungminjersey.png" alt="Product 7">
        <h3>Son Heung-Min Football Jersey</h3>
        <p>Mens Kits</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Son Heung-Min Football Jersey', this)"<?php } ?>>140,50€</button><br>
        <a href="details.php?product=Son%20Heung-Min%20Football%20Jersey" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/sophiasmithjersey.png" alt="Product 8">
        <h3>Sophia Smith Football Jersey</h3>
        <p>Womens Kits</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Sophia Smith Football Jersey', this)"<?php } ?>>135,50€</button><br>
        <a href="details.php?product=Sophia%20Smith%20Football%20Jersey" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/usajersey.png" alt="Product 9">
        <h3>USA Jersey</h3>
        <p>Mens Kits</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('USA Jersey', this)"<?php } ?>>150,00€</button><br>
        <a href="details.php?product=USA%20Jersey" class="btn">More Details</a>
      </div>
    </div>

    <h2 style="text-align:center; font-size: 20px;">Discover Our Tech Collection!</h2>
    <div class="products">
      <div class="product">
        <img src="images/niketechfleecered.png" alt="Product 10">
        <h3>Nike Sportswear Tech Fleece Red</h3>
        <p>Sports Fleece</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Fleece Red', this)"<?php } ?>>110,50€</button><br>
        <a href="details.php?product=Nike%20Sportswear%20Tech%20Fleece%20Red" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/niketechfleecegray.png" alt="Product 11">
        <h3>Nike Sportswear Tech Fleece Gray</h3>
        <p>Sports Fleece</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Fleece Gray', this)"<?php } ?>>110,50€</button><br>
        <a href="details.php?product=Nike%20Sportswear%20Tech%20Fleece%20Gray" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/niketechfleeceblack.png" alt="Product 12">
        <h3>Nike Sportswear Tech Fleece Black</h3>
        <p>Sports Fleece</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Fleece Black', this)"<?php } ?>>110,50€</button><br>
        <a href="details.php?product=Nike%20Sportswear%20Tech%20Fleece%20Black" class="btn">More Details</a>
      </div>
    </div>
    <h2 style="text-align:center; font-size: 20px;">Some of our nicest joggers!</h2>
    <div class="products">
      <div class="product">
        <img src="images/niketechjoggersred.png" alt="Product 1">
        <h3>Nike Sportswear Tech Joggers Red</h3>
        <p>Sports Joggers</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Joggers Red', this)"<?php } ?>>100,00€</button><br>
        <a href="details.php?product=Nike%20Tech%20Joggers%20Red" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/niketechjoggersgray.png" alt="Product 2">
        <h3>Nike Sportswear Tech Joggers Gray</h3>
        <p>Sports Joggers</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Joggers Gray', this)"<?php } ?>>100,00€</button><br>
        <a href="details.php?product=Nike%20Tech%20Joggers%20Gray" class="btn">More Details</a>
      </div>
      <div class="product">
        <img src="images/niketechjoggersblack.png" alt="Product 3">
        <h3>Nike Sportswear Tech Joggers Black</h3>
        <p>Sports Joggers</p>
        <button class="price-button" 
        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) { ?>
        onclick="updatePrice('Nike Sportswear Tech Joggers Black', this)"<?php } ?>>100,00€</button><br>
        <a href="details.php?product=Nike%20Tech%20Joggers%20Black" class="btn">More Details</a>
      </div>
    </div>
  </main>
  <footer>
    <p>&copy Nike remake by Ron Shala, Digital school</p>
  </footer>
  <script>
    function updatePrice(product, currentPriceElement) {
      let currentPrice = currentPriceElement.innerText.replace('€', '').trim();
      currentPrice = currentPrice.replace(',', '.');
      let newPrice = prompt("Enter the new price:", currentPrice);


      if (newPrice && !isNaN(newPrice) && parseFloat(newPrice) > 0) {
        newPrice = parseFloat(newPrice).toFixed(2).replace('.', ',');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "update_price.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === "Price updated successfully!") {
              currentPriceElement.innerText = newPrice + '€';
            } else {
              alert("Error updating price: " + xhr.responseText);
            }
          }
        };

        xhr.send("product=" + encodeURIComponent(product) + "&price=" + encodeURIComponent(newPrice));
      } else {
        alert("Please enter a valid price (numeric values only and greater than 0).");
      }
    }
  </script>


</body>

</html>